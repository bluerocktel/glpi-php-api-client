<?php

namespace BlueRockTEL\Glpi\Endpoints\TicketUsers;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use BlueRockTEL\Glpi\Enums\AttributionType;
use Saloon\Traits\Body\HasJsonBody;

class CreateTicketUserRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/Ticket/{$this->ticketId}/Ticket_User";
    }

    public function __construct(
        protected int $ticketId,
        protected int $userId,
        protected AttributionType $type,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        return [
            'input' => [
                'tickets_id' => $this->ticketId,
                'users_id' => $this->userId,
                'type' => $this->type->value,
            ],
        ];
    }
}
