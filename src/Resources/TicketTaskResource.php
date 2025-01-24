<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\Ticket;
use BlueRockTEL\Glpi\Endpoints\TicketTasks as Endpoints;
use Illuminate\Support\Collection;

class TicketTaskResource extends Resource
{
    public function show(int $ticketTaskId): Response
    {
        return $this->connector->send(
            new Endpoints\GetTicketTaskRequest(
                ticketTaskId: $ticketTaskId,
            )
        );
    }

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

    public function update(
        int $ticketTaskId,
        Collection $data,
    ): Response {
        return $this->connector->send(
            new Endpoints\UpdateTicketTaskRequest(
                ticketTaskId: $ticketTaskId,
                data: $data,
            )
        );
    }
}
