<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Endpoints\Profiles as Endpoints;
use Illuminate\Support\Collection;

class ProfileResource extends Resource
{
    public function search(
        Collection $criterias = new Collection(),
        Collection $columns = new Collection(),
        ?bool $isDeleted = null,
    ): Response {
        return $this->connector->send(
            new Endpoints\SearchProfilesRequest(
                criterias: $criterias,
                columns: $columns,
                isDeleted: $isDeleted,
            )
        );
    }
}
