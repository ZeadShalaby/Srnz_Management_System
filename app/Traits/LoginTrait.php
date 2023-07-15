<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Departments;
use Illuminate\Support\Facades\DB;
use Illuminate\Tests\Database\Fixtures\Models\Money\Price;

trait LoginTrait

{

protected function Check($request)
{

//login with phone number or email
    $value = $request->input('email'); // zead@admin.srnz or 215478963
    $field = filter_var($value,FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    $this->validate($request, [
        'email'=>'required',
        'password' => 'required|alphaNum|min:3'
    ]);

    $source = DB::table('users')->where($field, $request->email)
    ->first();
    $user_data = array(
        $field => $request->get('email'),
        'password' => $request->get('password')
    ); 


    $result = new User;
    $result->user_data = $user_data; // some variable
    $result->source = $source; // some variable

    return $result;
    
}





}