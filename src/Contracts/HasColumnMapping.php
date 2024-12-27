<?php

namespace BlueRockTEL\Glpi\Contracts;

use Illuminate\Support\Collection;

interface HasColumnMapping
{
    public static function columnMap(): Collection;
}
