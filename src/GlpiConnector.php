<?php

namespace BlueRockTEL\Glpi;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Limit;
use BlueRockTEL\Glpi\Endpoints\AuthRequest;
use Saloon\Http\Auth\HeaderAuthenticator;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use BlueRockTEL\Glpi\Exceptions\AuthenticationException;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;

class GlpiConnector extends Connector implements HasPagination
{
    use HasRateLimits;

    protected string $sessionToken;

    public function __construct(
        protected string $apiUrl,
        #[\SensitiveParameter]
        protected string $appToken,
        #[\SensitiveParameter]
        protected string $userToken,
    ) {
        $this->setAccessToken();
    }

    protected function setAccessToken()
    {
        $response = $this->send(
            new AuthRequest($this->appToken, $this->userToken)
        );

        if ($response->failed()) {
            throw new AuthenticationException(
                sprintf('Failed to authenticate with GLPI, status code `%s`. Please verify your credentials.', $response->status()),
            );
        }

        if (blank($sessionToken = $response->json('session_token'))) {
            throw new AuthenticationException(
                'Failed to authenticate with GLPI. Value `session_token` missing from Auth response.',
            );
        }

        $this->sessionToken = $sessionToken;

        $this->authenticate(new HeaderAuthenticator($this->sessionToken, 'Session-Token'));
    }

    public function resolveBaseUrl(): string
    {
        return $this->apiUrl;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'App-Token' => $this->appToken,
        ];
    }

    protected function defaultQuery(): array
    {
        return [];
    }

    public function defaultConfig(): array
    {
        return [
            'timeout' => 20,
        ];
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(requests: 200, threshold: 0.9)->everyMinute()->sleep(),
        ];
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new MemoryStore;
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            protected ?int $perPageLimit = 20;

            protected function isLastPage(Response $response): bool
            {
                return $response->json('last_page')
                    && $response->json('last_page') === $response->json('current_page');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $request->createDtoFromResponse($response->json('data'));
            }
        };
    }

    public function user(): Resources\UserResource
    {
        return new Resources\UserResource($this);
    }

    public function profile(): Resources\ProfileResource
    {
        return new Resources\ProfileResource($this);
    }

    public function ticket(): Resources\TicketResource
    {
        return new Resources\TicketResource($this);
    }
}
