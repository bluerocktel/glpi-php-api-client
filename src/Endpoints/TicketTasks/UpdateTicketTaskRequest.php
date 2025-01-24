<?php

namespace BlueRockTEL\Glpi\Endpoints\TicketTasks;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class UpdateTicketTaskRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/TicketTask/{$this->ticketTaskId}";
    }

    public function __construct(
        protected int $ticketTaskId,
        protected Collection $data,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        $data = $this->data->toArray();

        return [
            'input' => $data,
        ];
    }
}
