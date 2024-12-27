<?php

namespace BlueRockTEL\Glpi\Entities\Columns;

use BlueRockTEL\Glpi\Contracts\EntityMap;
use BlueRockTEL\Glpi\Concerns\MapsColumns;

enum UserMap: int implements EntityMap
{
    use MapsColumns;

    case id = 2;
    case name = 1;
    case realname = 34;
    case firstname = 9;
    case email = 5;
    case phone = 6;
    case phone2 = 10;
    case mobile = 11;
    case is_active = 8;
    case entity_name = 80;
    case user_category_name = 82;
}
