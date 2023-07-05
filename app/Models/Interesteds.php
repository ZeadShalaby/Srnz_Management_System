<?php

namespace App\Models;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class interesteds extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
//