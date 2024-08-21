<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class clientObserver
{
    /**
     * Delete cache function
     */
    private function deleteCache()
    {
        Cache::tags(['clients'])->flush();
        Cache::tags(['clientFilter'])->flush();
        Cache::forget('clientList');
    }
    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        $this->deleteCache();
    }
}
