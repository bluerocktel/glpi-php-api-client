<?php

namespace BlueRockTEL\Glpi\Endpoints\UserProfiles;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteUserProfileRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/Profile_User/{$this->userProfileId}";
    }

    public function __construct(
        protected int $userProfileId,
    ) {
        //
    }
}
