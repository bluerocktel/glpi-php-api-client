<?php

namespace BlueRockTEL\Glpi\Concerns;

use Illuminate\Support\Collection;

trait MapsColumns
{
    public static function mapByNames(): Collection
    {
        return collect(static::cases())
            ->mapWithKeys(fn ($value) => [$value->name => $value->value]);
    }

    public static function mapByColumns(): Collection
    {
        return collect(static::cases())
            ->mapWithKeys(fn ($value) => [$value->value => $value->name]);
    }

    public static function all(): Collection
    {
        return collect(static::cases());
    }

    public static function fromName(string $name): ?static
    {
        return static::tryFrom(
            static::mapByNames()->get($name, null)
        );
    }

    public static function fromColumn(int $column): ?static
    {
        return static::tryFrom($column);
    }
}
