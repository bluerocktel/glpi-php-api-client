<?php

namespace BlueRockTEL\Glpi\Concerns;

use Saloon\Http\PendingRequest;

trait DisablesSSLVerification
{
    /**
     * Disable SSL verification on requests. I hope you know this is bad.
     *
     * @param \Saloon\Contracts\PendingRequest $pendingRequest
     * @return void
     */
    public function bootDisablesSSLVerification(PendingRequest $pendingRequest): void
    {
        $pendingRequest->config()->merge([
            'verify' => false,
        ]);
    }
}
