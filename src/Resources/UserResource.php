<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\User;
use BlueRockTEL\Glpi\Endpoints\Users as Endpoints;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    public function search(
        Collection $criterias = new Collection(),
        Collection $columns = new Collection(),
        ?bool $isDeleted = null,
    ): Response {
        return $this->connector->send(
            new Endpoints\SearchUsersRequest(
                criterias: $criterias,
                columns: $columns,
                isDeleted: $isDeleted,
            )
        );
    }

    public function show(int $id): Response
    {
        return $this->connector->send(
            new Endpoints\GetUserRequest($id)
        );
    }

    public function store(Collection $data): Response
    {
        return $this->connector->send(
            new Endpoints\CreateUserRequest($data)
        );
    }

    public function update(int $id, Collection $data): Response
    {
        return $this->connector->send(
            new Endpoints\UpdateUserRequest($id, $data)
        );
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteUserRequest($id)
        );
    }

    public function profile(): UserProfileResource
    {
        return new UserProfileResource($this->connector);
    }
}
