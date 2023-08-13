<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Departments;
use App\Models\Interesteds;
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
        $checkname = User::where('name',$request->name)->get()->value('id');
        $checkgmail = User::where('gmail',$request->gmail)->get()->value('id');
        $checkphone = User::where('phone',$request->phone)->get()->value('id');

        if($checkemail>0){
            $msg = 'Email Alredy Exists .';
            return response()->json([
                'status'=>0,
                'error'=>0,
                'type'=>'error_email',
                'error'=>$msg,
            ]);
        }
        elseif($checkname>0){
            $msg = 'Name Alredy Exists .';
            return response()->json([
                'status'=>1,
                'error'=>1,
                'type'=>'error_name',
                'error_name'=>$msg,

            ]);}
        elseif($checkgmail>0){
            $msg = 'Gmail Alredy Exists .';
            return response()->json([
                'status'=>2,
                'error'=>2,
                'type'=>'error_gmail',
                'error_name'=>$msg,

            ]);}
            elseif($checkphone>0){
                $msg = 'Phone Alredy Exists .';
                return response()->json([
                    'status'=>3,
                    'error'=>3,
                    'type'=>'error_phone',
                    'error_name'=>$msg,
    
                ]);}
        else{
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'gmail'=>$request->gmail,
            'profile_photo'=>"",
            'phone'=>$request->phone,
            'password'=> $request->password,
            'role'=>Role::CUSTOMER,
            'remember_token' => Str::random(10),
         ]);        
         $msg = 'create sucessfuly .';
         return response()->json([
             'status'=>true,
             'sucess'=>$msg,
         ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Departments $registration)
    {
        //
        $check = auth()->user();
        if(!$check){
           $check = 0 ;
           return view('errors.403');
        }
        else{
        $useres = auth()->user();
        $orders = Orders::where('department_id',$registration->id)->paginate(10);
        $orders_user = Orders::where('user_id', Auth::user()->id)->get();
        $interested = Interesteds::get();
        $departments = Departments::get();
        if($interested){
            if(auth()->user()->role==Role::ADMIN)
        return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'check'=>Role::ADMIN,'SeAdmin'=>$useres,'Departments'=>$departments]);
            else{
                return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'orders_user'=>$orders_user,'SeCustomer'=>$useres,'Departments'=>$departments]);
            }
        }
        else{
            if(auth()->user()->role==Role::ADMIN)
            return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'check'=>Role::ADMIN,'SeAdmin'=>$useres,'Departments'=>$departments]);
            else{
                return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'orders_user'=>$orders_user,'SeCustomer'=>$useres,'Departments'=>$departments]);
            }
        }
        }

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
