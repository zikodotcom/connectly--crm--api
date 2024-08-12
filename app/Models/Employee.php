<?php

namespace App\Models;

use App\Observers\employeeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected static function boot()
    {
        parent::boot();

        static::observe(employeeObserver::class);
    }
}
