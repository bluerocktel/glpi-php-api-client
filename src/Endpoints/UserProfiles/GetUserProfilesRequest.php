<?php

namespace BlueRockTEL\Glpi\Endpoints\UserProfiles;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserProfilesRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/User/{$this->userId}/Profile_User";
    }

    public function __construct(
        protected int $userId,
    ) {
        //
    }
}
