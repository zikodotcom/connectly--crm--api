<?php

namespace App\Models;

use App\Observers\employeeObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $primaryKey = 'id_e';
    protected $fillable = [
        'fullName',
        'userName',
        'email',
        'phone',
        'adresse',
        'city',
        'state',
        'zipCode',
        'country',
        'photo',
        'role',
        'salary',
    ];
    protected $hidden = ['pivot'];

    protected static function boot()
    {
        parent::boot();

        static::observe(employeeObserver::class);
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'team', 'id_e', 'id');
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'collaborators',  'id_e',  'id_task');
    }
}
