<?php

namespace BlueRockTEL\Glpi\Endpoints\Tickets;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateTicketRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/Ticket';
    }

    public function __construct(
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
