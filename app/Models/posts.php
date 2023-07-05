<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class posts extends Model
{
    use HasFactory;
    
    protected $fillabel = ['title','description'];

    protected $dates = ['deleted_at'];
}
