<?php

namespace BlueRockTEL\Glpi\Endpoints\TicketTasks;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use BlueRockTEL\Glpi\Entities\TicketTask;

class GetTicketTaskRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/TicketTask/{$this->ticketTaskId}";
    }

    public function __construct(
        protected int $ticketTaskId,
    ) {
        //
    }

    public function createDtoFromResponse(Response $response): TicketTask
    {
        return TicketTask::fromResponse($response);
    }
}
