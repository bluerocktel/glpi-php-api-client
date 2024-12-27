<?php

namespace BlueRockTEL\Glpi\Endpoints\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateUserRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/User';
    }

    public function __construct(
        protected Collection $data,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        $data = $this->data->toArray();

        // Name is mandatory (acts as username)
        if (!Arr::get($data, 'name')) {
            $data['name'] = Arr::get($data, 'firstname') . Arr::get($data, 'realname');
        }

        return [
            'input' => $data,
        ];
    }
}
