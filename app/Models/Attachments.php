<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;
    protected $table = 'attachments';
    protected $fillable = [
        'id_attachment',
        'attach_name',
        'attach_link',
        'id_task',
        'size'
    ];
    protected $primaryKey = 'id_attachment';

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task', 'id_task');
    }
}
