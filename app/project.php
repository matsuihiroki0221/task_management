<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable =[
        'title',
        'content',
        'project_leader',
        'time_limit',
        

    ];
}
