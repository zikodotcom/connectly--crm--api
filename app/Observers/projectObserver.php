<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class projectObserver
{
    private function deleteCache()
    {
        Cache::tags(['projects'])->flush();
        Cache::tags(['projectFilter'])->flush();
        Cache::forget('projectList');
    }
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        $this->deleteCache();
    }
}
