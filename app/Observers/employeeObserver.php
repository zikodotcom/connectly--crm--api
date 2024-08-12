<?php

namespace App\Observers;

use App\Models\Employee;
use Illuminate\Support\Facades\Cache;

class employeeObserver
{
    /**
     * Delete cache functio
     */
    private function deleteCache()
    {
        Cache::tags(['employees'])->flush();
        Cache::tags(['employeeFilter'])->flush();
    }
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        $this->deleteCache();
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        $this->deleteCache();
    }
}
