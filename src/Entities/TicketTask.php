<?php

namespace BlueRockTEL\Glpi\Entities;

use Carbon\Carbon;

class TicketTask extends AbstractEntity
{
    protected static $arrayCast = [
        'date' => 'datetime',
        'date_creation' => 'datetime',
        'date_mod' => 'datetime',
    ];

    public function __construct(
        public readonly int $id,
        public readonly ?string $uuid = null,
        public readonly null|array|int $tickets_id = null,
        public readonly null|array|int $taskcategories_id = null,
        public readonly ?Carbon $date = null,
        public readonly null|array|int $users_id = null,
        public readonly ?int $users_id_editor = null,
        public readonly ?int $users_id_tech = null,
        public readonly ?int $groups_id_tech = null,
        public readonly ?string $content = null,
        public readonly ?bool $is_private = null,
        public readonly ?int $actiontime = null,
        public readonly ?string $begin = null,
        public readonly ?string $end = null,
        public readonly ?int $state = null,
        public readonly ?Carbon $date_mod = null,
        public readonly ?Carbon $date_creation = null,
        public readonly ?int $tasktemplates_id = null,
        public readonly ?int $timeline_position = null,
        public readonly ?int $sourceitems_id = null,
        public readonly ?int $sourceof_items_id = null,
        public readonly ?array $links = null,
    ) {
        //
    }
}
