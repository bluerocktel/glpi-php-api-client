<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\User;
use BlueRockTEL\Glpi\Endpoints\UserProfiles as Endpoints;
use Illuminate\Support\Collection;

class UserProfileResource extends Resource
{
    public function index(int $userId): Response
    {
        return $this->connector->send(
            new Endpoints\GetUserProfilesRequest($userId)
        );
    }

    public function store(
        int $userId,
        int $entityId,
        int $profileId,
        bool $isRecursive = false,
    ): Response {
        return $this->connector->send(
            new Endpoints\CreateUserProfileRequest(
                userId: $userId,
                entityId: $entityId,
                profileId: $profileId,
                isRecursive: $isRecursive,
            )
        );
    }

    public function delete(int $userProfileId): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteUserProfileRequest($userProfileId)
        );
    }
}
