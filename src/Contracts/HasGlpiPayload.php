<?php

namespace BlueRockTEL\Glpi\Contracts;

interface HasGlpiPayload
{
    public function toGlpiPayload(): array;
}
