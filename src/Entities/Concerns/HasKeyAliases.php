<?php

namespace BlueRockTEL\Glpi\Entities\Concerns;

trait HasKeyAliases
{
    /**
     * The aliases from API source to local Entity.
     *
     * @var array
     */
    protected static $aliases = [];

    public static function getDefinedAliases(): array
    {
        return static::$aliases ?? [];
    }

    public static function replaceAliases(array $values): array
    {
        $aliases = static::getDefinedAliases();

        return collect($values)
                ->mapWithKeys(function ($value, $key) use ($aliases) {
                    $alias = $aliases[$key] ?? $key;
                    return [$alias => $value];
                })
                ->toArray();
    }
}
