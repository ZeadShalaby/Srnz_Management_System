<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationExceptio;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function homepage()
    {
        $user = auth()->user();
      if (Auth::user()->role == Role::ADMIN) {
            return view('home-page.admin',['SeAdmin'=>$user]);
        }
        else{return view('home-page.customer',['SeCustomer'=>$user]);}    
    }

    //login
    function loginindex()
    {
        return view('login');
    }

    /**
     * @throws ValidationException
     */
    function checklogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3'
        ]);
       $source = DB::table('users')->where('email', $request->email)->first();
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );



        if (!(Auth::attempt($user_data))) {
            return back()->with('error', 'Wrong Login Details');
        }
        if (Auth::user()->role == Role::ADMIN) {
            return view('home-page.admin',['SeAdmin'=>$source]);
        }
        if (Auth::user()->role == Role::CUSTOMER) {

            return view('home-page.customer',['SeCustomer'=>$source]);

        }
        
        return redirect('/login');
    }


    function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
