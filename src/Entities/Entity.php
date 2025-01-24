<?php

namespace BlueRockTEL\Glpi\Entities;

use BlueRockTEL\Glpi\Entities\Columns\EntityMap;

class Entity extends GlpiEntity
{
    /**
     * @var null|string<class>
     */
    public static ?string $mappedBy = EntityMap::class;

    protected static $arrayCast = [];

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $phone = null,
        public readonly ?string $email = null,
        public readonly ?string $website = null,
        public readonly ?string $address = null,
        public readonly ?string $fax = null,
        public readonly ?string $town = null,
        public readonly ?string $state = null,
        public readonly ?string $country = null,
        public readonly ?string $name_alternate = null,
        public readonly ?string $postcode = null,
        public readonly ?string $registration_number = null,
    ) {
        //
    }
}
