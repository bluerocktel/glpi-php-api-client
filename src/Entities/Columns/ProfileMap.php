<?php

namespace BlueRockTEL\Glpi\Entities\Columns;

use BlueRockTEL\Glpi\Contracts\EntityMap;
use BlueRockTEL\Glpi\Concerns\MapsColumns;

enum ProfileMap: int implements EntityMap
{
    use MapsColumns;

    case id = 2;
    case name = 1;
    case entity_name = 3;
    case created_at = 19;
}
