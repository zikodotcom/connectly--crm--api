<?php

namespace App\Models;

use App\Observers\taskObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $primaryKey = 'id_task';
    protected $fillable = [
        'taskName',
        'description',
        'dateS',
        'dateF',
        'status',
        'priority',
        'id'
    ];
    protected static function boot()
    {
        parent::boot();

        static::observe(taskObserver::class);
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'id');
    }
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachments::class, 'id_task', 'id_task');
    }

    public function collaborators(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'collaborators', 'id_task',  'id_e');
    }
}
