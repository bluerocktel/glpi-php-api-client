<?php

namespace BlueRockTEL\Glpi\Contracts;

use Illuminate\Support\Collection;

interface EntityMap
{
    public static function mapByNames(): Collection;
    public static function mapByColumns(): Collection;
}
