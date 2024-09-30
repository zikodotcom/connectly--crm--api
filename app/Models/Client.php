<?php

namespace App\Models;

use App\Observers\clientObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $primaryKey = 'idC';
    protected $fillable = [
        'image',
        'clientName',
        'email',
        'phone',
        'website',
        'owner',
        'industry',
        'currency',
        'languages',
        'description',
        'adresse',
        'city',
        'state',
        'country',
        'zipCode',
        'facebook',
        'linkedin',
        'twitter',
        'instgram',
        'whatsapp'
    ];
    protected static function boot()
    {
        parent::boot();

        static::observe(ClientObserver::class);
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class);
    }
}
