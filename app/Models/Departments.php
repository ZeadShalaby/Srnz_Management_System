<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departments extends Model
{
    use HasFactory,SoftDeletes;

    /**
  * The attributes that are mass assignable.
  *
  * @var array<int, string>
  */
 protected $fillable = [
     'name',
     'code',
     'img',
 ];

 protected $dates =['delete_at'];


 protected $hidden = [
     'created_at',
     'updated_at',
     'deleted_at',
 ];

 

}

