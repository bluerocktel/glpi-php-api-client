<?php

namespace BlueRockTEL\Glpi\Entities\Columns;

use BlueRockTEL\Glpi\Contracts\EntityMap as EntityMapContract;
use BlueRockTEL\Glpi\Concerns\MapsColumns;

enum EntityMap: int implements EntityMapContract
{
    use MapsColumns;

    case id = 2;
    case name = 1;
    case phone = 5;
    case email = 6;
    case website = 4;
    case address = 3;
    case fax = 10;
    case town = 11;
    case state = 12;
    case country = 13;
    case name_alternate = 14;
    case postcode = 25;
    case registration_number = 70;
}
