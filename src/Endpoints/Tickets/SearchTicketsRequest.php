<?php

namespace BlueRockTEL\Glpi\Endpoints\Tickets;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use BlueRockTEL\Glpi\Entities\Ticket;
use BlueRockTEL\Glpi\EntityCollection;
use BlueRockTEL\Glpi\Contracts\EntityMap;
use Illuminate\Support\Collection;
use BlueRockTEL\Glpi\Entities\SearchCriteria;

class SearchTicketsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/search/Ticket';
    }

    public function __construct(
        protected Collection $criterias = new Collection(),
        protected Collection $columns = new Collection(),
        protected ?bool $isDeleted = null,
    ) {
        //
    }

    protected function defaultQuery(): array
    {
        $criteria = $this->criterias->map(fn (SearchCriteria $criteria) => $criteria->toGlpiPayload());
        $columns = $this->columns->map(fn (EntityMap $map) => $map->value);

        return [
            ...($this->isDeleted !== null ? ['is_deleted' => (int) $this->isDeleted] : []),
            ...($criteria->isNotEmpty() ? ['criteria' => $criteria->toArray()] : []),
            ...($columns->isNotEmpty() ? ['forcedisplay' => $columns->toArray()] : []),
        ];
    }

    public function createDtoFromResponse(Response $response): EntityCollection
    {
        return EntityCollection::fromResponse($response, Ticket::class, 'data');
    }
}
