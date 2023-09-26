<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    use HasFactory;
    public $timesstamps=false;
    protected $fillable =[
        'id',
        'name',
        'done'

    ];
}
