<?php

namespace BlueRockTEL\Glpi\Entities\Casts;

use BlueRockTEL\Glpi\Contracts\CastsAttributes;
use BlueRockTEL\Glpi\Enums\AttributionType;

class AttributionTypeCast implements CastsAttributes
{
    public static function from(?int $from = null): ?AttributionType
    {
        if ($from === null) {
            return null;
        }

        if ($from instanceof AttributionType) {
            return $from;
        }

        return AttributionType::from($from);
    }

    public static function tryFrom($from): ?AttributionType
    {
        try {
            return static::from($from);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
