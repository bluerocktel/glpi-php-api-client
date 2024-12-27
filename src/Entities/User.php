<?php

namespace BlueRockTEL\Glpi\Entities;

use BlueRockTEL\Glpi\Entities\Columns\UserMap;

class User extends GlpiEntity
{
    /**
     * @var null|string<class>
     */
    public static ?string $mappedBy = UserMap::class;

    protected static $arrayCast = [];

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $realname = null,
        public readonly ?string $firstname = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $phone2 = null,
        public readonly ?string $mobile = null,
        public readonly ?bool $is_active = null,
        public readonly ?array $entity_name = null,
        public readonly ?string $user_category_name = null,
    ) {
        //
    }
}
