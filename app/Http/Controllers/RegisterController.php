<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('registration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $source = DB::table('users')->where('email', $request->email)->first();

        $formFields = $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'gmail'=> 'required',
            'password'=> 'required',
            'phone'=> 'required',
        ]);

        //check before create
        $checkemail = User::where('email',$request->email)->get()->value('id');
        $checkname = DB::table('users')->where('name',$request->name)->get()->value('id');
        if($checkemail>0){
            return back()->with('error','Email Alredy Exist');
        }
        elseif($checkname>0){
            return back()->with('error','Name Alredy Exist');
        }
        else{
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'gmail'=>$request->gmail,
            'profile_photo'=>"jjjjjjj",
            'phone'=>$request->phone,
            'password'=> $request->password,
            'role'=>Role::CUSTOMER,
            'remember_token' => Str::random(10),
         ]);        
         
        return Redirect('login')->with('status','create sucessfuly');
        }
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
    public function destroy(User $registration)
    {
        //
        if(Auth::user()){
           $registration->delete();
           return Redirect('login')->with('status', 'Delete Successfully');
        }
        else{
            return view('errors.403');
        }
    }
}
