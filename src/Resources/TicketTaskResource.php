<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\Ticket;
use BlueRockTEL\Glpi\Endpoints\TicketTasks as Endpoints;
use Illuminate\Support\Collection;

class TicketTaskResource extends Resource
{
    public function store(
        int $ticketId,
        Collection $data,
    ): Response {
        return $this->connector->send(
            new Endpoints\CreateTicketTaskRequest(
                ticketId: $ticketId,
                data: $data,
            )
        );
    }
}
