<?php

namespace App\Models;

use App\Observers\projectObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
