<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\Ticket;
use BlueRockTEL\Glpi\Endpoints\Tickets as Endpoints;
use Illuminate\Support\Collection;

class TicketResource extends Resource
{
    public function search(
        Collection $criterias = new Collection(),
        Collection $columns = new Collection(),
        ?bool $isDeleted = null,
    ): Response {
        return $this->connector->send(
            new Endpoints\SearchTicketsRequest(
                criterias: $criterias,
                columns: $columns,
                isDeleted: $isDeleted,
            )
        );
    }

    public function store(Collection $data): Response
    {
        return $this->connector->send(
            new Endpoints\CreateTicketRequest(
                data: $data,
            )
        );
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(
            new Endpoints\DeleteTicketRequest($id)
        );
    }

    public function task(): TicketTaskResource
    {
        return new TicketTaskResource($this->connector);
    }

    public function user(): TicketUserResource
    {
        return new TicketUserResource($this->connector);
    }
}
