<?php

namespace BlueRockTEL\Glpi\Entities;

use Saloon\Http\Response;
use Illuminate\Support\Collection;
use Saloon\Traits\Responses\HasResponse;
use Saloon\Contracts\DataObjects\WithResponse;
use BlueRockTEL\Glpi\Contracts\Entity as EntityContract;

abstract class AbstractEntity implements EntityContract, WithResponse
{
    use HasResponse;
    use Concerns\CreatesFromArray;
    use Concerns\CastArrayValues;
    use Concerns\HasKeyAliases;

    public static function fromResponse(Response $response, null|string|int $path = null): static
    {
        return static::fromArray(
            (array) $response->json($path)
        );
    }

    public static function tryFromResponse(Response $response): ?static
    {
        try {
            return static::fromResponse($response);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function fromArray(array $data): static
    {
        $data = static::replaceAliases($data);

        static::castArrayValues($data);

        return static::createFromArray($data);
    }

    public static function tryFromArray(array $data): ?static
    {
        try {
            return static::fromArray($data);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function toArray(bool $filter = false): array
    {
        $data = get_object_vars($this);

        return $filter
            ? array_filter($data, fn ($i) => $i !== null)
            : $data;
    }

    public function toCollection(bool $filter = false): Collection
    {
        return new Collection(
            $this->toArray($filter)
        );
    }
}
