<?php

namespace App\Models;

use App\Observers\projectObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $fillable = [
        'projectName',
        'dateS',
        'dateF',
        'priority',
        'status',
        'description',
        'amount',
        'idC',
        'responsable'
    ];
    protected static function boot()
    {
        parent::boot();

        static::observe(projectObserver::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'team', 'id', 'id_e');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'idC', 'idC');
    }
    public function respProject(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'responsable', 'id_e');
    }
}
