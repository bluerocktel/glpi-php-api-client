<?php

namespace BlueRockTEL\Glpi\Resources;

use Saloon\Http\Response;
use BlueRockTEL\Glpi\Enums\AttributionType;
use BlueRockTEL\Glpi\Endpoints\TicketUsers as Endpoints;

class TicketUserResource extends Resource
{
    public function store(
        int $ticketId,
        int $userId,
        AttributionType $type,
    ): Response {
        return $this->connector->send(
            new Endpoints\CreateTicketUserRequest(
                ticketId: $ticketId,
                userId: $userId,
                type: $type,
            )
        );
    }
}
