<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class taskObserver
{
    private function deleteCache()
    {
        Cache::tags(['tasks'])->flush();
    }
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        $this->deleteCache();
    }
}
