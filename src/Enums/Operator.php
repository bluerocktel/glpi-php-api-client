<?php

namespace BlueRockTEL\Glpi\Enums;

enum Operator: string
{
    case EQUALS = 'equals';
    case CONTAINS = 'contains';
    case LESS_THAN = 'lessthan';
    case MORE_THAN = 'morethan';
}
