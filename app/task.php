<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'project_title',
        'title',
        'content',
        'time_limit',
        'importance',
        'done'
    ];
}
