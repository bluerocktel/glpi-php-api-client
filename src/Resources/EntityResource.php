<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Endpoints\Entities as Endpoints;
use Illuminate\Support\Collection;

class EntityResource extends Resource
{
    public function search(
        Collection $criterias = new Collection(),
        Collection $columns = new Collection(),
        ?bool $isDeleted = null,
    ): Response {
        return $this->connector->send(
            new Endpoints\SearchEntitiesRequest(
                criterias: $criterias,
                columns: $columns,
                isDeleted: $isDeleted,
            )
        );
    }
}
