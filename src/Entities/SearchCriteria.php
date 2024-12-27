<?php

namespace BlueRockTEL\Glpi\Entities;

use BlueRockTEL\Glpi\Enums\Boolean;
use BlueRockTEL\Glpi\Enums\Operator;
use BlueRockTEL\Glpi\Entities\Entity;
use BlueRockTEL\Glpi\Contracts\EntityMap;
use BlueRockTEL\Glpi\Contracts\HasGlpiPayload;

class SearchCriteria extends Entity implements HasGlpiPayload
{
    public function __construct(
        readonly public int|EntityMap $field,
        readonly public Operator $operator,
        readonly public mixed $value,
        readonly public ?Boolean $boolean = null,
    ) {
        //
    }

    public function toGlpiPayload(): array
    {
        $field = is_a($this->field, EntityMap::class) ? $this->field->value : $this->field;

        return [
            'field' => $field,
            'searchtype' => $this->operator->value,
            'value' => $this->value,
            ...($this->boolean !== null ? ['link' => $this->boolean->value] : []),
        ];
    }
}
