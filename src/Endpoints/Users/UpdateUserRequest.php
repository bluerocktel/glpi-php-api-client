<?php

namespace BlueRockTEL\Glpi\Endpoints\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class UpdateUserRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/User/{$this->userId}";
    }

    public function __construct(
        protected int $userId,
        protected Collection $data,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        $data = $this->data->toArray();

        return [
            'input' => $data,
        ];
    }
}
