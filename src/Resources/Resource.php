<?php

namespace BlueRockTEL\Glpi\Resources;

use BlueRockTEL\Glpi\GlpiConnector;

abstract class Resource
{
    public function __construct(
        protected GlpiConnector $connector
    ) {
        //
    }
}
