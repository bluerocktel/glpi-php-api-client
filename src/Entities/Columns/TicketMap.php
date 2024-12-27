<?php

namespace BlueRockTEL\Glpi\Entities\Columns;

use BlueRockTEL\Glpi\Contracts\EntityMap;
use BlueRockTEL\Glpi\Concerns\MapsColumns;

enum TicketMap: int implements EntityMap
{
    use MapsColumns;

    case id = 2;
    case name = 1;
    case entity_name = 80;
    case itilcategory_name = 7;
    case actiontime = 45;
    case status = 12;
    case date_creation = 15;
    case date_mod = 19;
    case assigned_id = 4;
    case applicant_id = 5;
    case group_name = 8;
    case type = 14;
    case solvedate = 17;
    case content = 21;
    case task_actiontime = 96;
    case task_content = 26;
}
