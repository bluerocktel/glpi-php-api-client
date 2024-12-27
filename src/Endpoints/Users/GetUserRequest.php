<?php

namespace BlueRockTEL\Glpi\Endpoints\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\User;

class GetUserRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/User/{$this->userId}";
    }

    public function __construct(
        protected int $userId,
    ) {
        //
    }

    public function createDtoFromResponse(Response $response): User
    {
        return User::fromResponse($response);
    }
}
