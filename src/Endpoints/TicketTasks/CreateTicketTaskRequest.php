<?php

namespace BlueRockTEL\Glpi\Endpoints\TicketTasks;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateTicketTaskRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/Ticket/{$this->ticketId}/TicketTask";
    }

    public function __construct(
        protected int $ticketId,
        protected Collection $data,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        $data = $this->data->toArray();

        if (!isset($data['tickets_id'])) {
            $data['tickets_id'] = $this->ticketId;
        }

        return [
            'input' => $data,
        ];
    }
}
