<?php

namespace BlueRockTEL\Glpi\Entities;

use Carbon\Carbon;
use BlueRockTEL\Glpi\Enums\AttributionType;
use BlueRockTEL\Glpi\Entities\Columns\TicketMap;

class Ticket extends GlpiEntity
{
    /**
     * @var null|string<class>
     */
    public static ?string $mappedBy = TicketMap::class;

    protected static $arrayCast = [
        'date_creation' => 'datetime',
        'date_mod' => 'datetime',
    ];

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $entity_name = null,
        public readonly ?string $itilcategory_name = null,
        public readonly ?int $actiontime = null,
        public readonly ?int $status = null,
        public readonly ?Carbon $date_creation = null,
        public readonly ?Carbon $date_mod = null,
        public readonly ?int $assigned_id = null,
        public readonly ?int $applicant_id = null,
        public readonly ?string $group_name = null,
        public readonly ?AttributionType $type = null,
        public readonly ?Carbon $solvedate = null,
        public readonly ?Carbon $task_actiontime = null,
        public readonly ?string $task_content = null,
    ) {
        //
    }
}
