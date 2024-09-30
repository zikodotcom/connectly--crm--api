<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;
    protected $table = 'attachments';
    protected $fillable = [
        'attach_name',
        'attach_link',
        'id_task'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task', 'id_task');
    }
}
