<?php

namespace BlueRockTEL\Glpi\Endpoints;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class AuthRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/initSession';
    }

    public function __construct(
        #[\SensitiveParameter]
        protected string $appToken,
        #[\SensitiveParameter]
        protected string $userToken,
    ) {
        //
    }

    protected function defaultHeaders(): array
    {
        return [
            'App-Token' => $this->appToken,
            'Authorization' => "user_token {$this->userToken}",
        ];
    }
}
