<?php

namespace BlueRockTEL\Glpi\Endpoints\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteUserRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return '/User/' . $this->id;
    }

    public function __construct(
        protected int $id,
    ) {
        //
    }
}
