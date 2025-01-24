<?php

namespace BlueRockTEL\Glpi\Entities;

use BlueRockTEL\Glpi\Contracts\EntityMap;
use Illuminate\Support\Collection;
use BlueRockTEL\Glpi\Contracts\HasColumnMapping;
use BlueRockTEL\Glpi\Exceptions\ColumnMappingException;

abstract class GlpiEntity extends AbstractEntity implements HasColumnMapping
{
    /**
     * @var null|string<\BlueRockTEL\Glpi\Contracts\EntityMap>
     */
    public static ?string $mappedBy;

    public static function fromArray(array $data): static
    {
        $map = static::columnMap();

        $data = collect($data)
            ->mapWithKeys(fn ($value, $key) => [$map->get($key, $key) => $value])
            ->toArray();

        return parent::fromArray($data);
    }

    public static function columnMap(): Collection
    {
        if (!static::$mappedBy) {
            throw new ColumnMappingException('No mapping defined for ' . static::class);
        }

        if (!class_exists(static::$mappedBy)) {
            throw new ColumnMappingException('Mapping class ' . static::$mappedBy . ' does not exist');
        }

        if (!in_array(EntityMap::class, class_implements(static::$mappedBy))) {
            throw new ColumnMappingException('Mapping class ' . static::$mappedBy . ' does not implement ' . EntityMap::class);
        }

        return static::$mappedBy::mapByColumns();
    }
}
