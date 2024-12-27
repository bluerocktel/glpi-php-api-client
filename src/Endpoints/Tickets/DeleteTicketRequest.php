<?php

namespace BlueRockTEL\Glpi\Endpoints\Tickets;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTicketRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return '/Ticket/' . $this->id;
    }

    public function __construct(
        protected int $id,
    ) {
        //
    }
}
