<?php

namespace App\Models;

use App\Models\User;
use App\Models\Orders;
use App\Models\Departments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Orders extends Model
{
    use HasFactory,SoftDeletes;
       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'department_id',
        'gmail',
        'phone',
        'description',
        'price',
        'path',
    ];
   
    protected $dates =['delete_at'];


    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
