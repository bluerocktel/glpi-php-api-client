<?php

namespace BlueRockTEL\Glpi\Endpoints\UserProfiles;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateUserProfileRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/User/{$this->userId}/Profile_User";
    }

    public function __construct(
        protected int $userId,
        protected int $entityId,
        protected int $profileId,
        protected bool $isRecursive = false,
    ) {
        //
    }

    protected function defaultBody(): array
    {
        return [
            'input' => array_filter([
                'entities_id' => (string )$this->entityId,
                'profiles_id' => (string )$this->profileId,
                'users_id' => (string )$this->userId,
                'is_recursive' => (int) $this->isRecursive,
            ]),
        ];
    }
}
