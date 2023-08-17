<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Traits\ImgTrait;
use App\Traits\LoginTrait;
use App\Models\Interesteds;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationExceptio;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ImgTrait;
    use LoginTrait;
    public function index()
    {
        //
        $user = auth()->user();
        $usersrole = Role::CUSTOMER;
        $users = User::where('role',Role::CUSTOMER)->paginate(10);
        
        return view('users.index',['users'=>$users,'roles'=>1,'SeAdmin'=>$user,'usersrole'=>$usersrole]);

    }

    public function admin(){
        $user = auth()->user();
        $usersrole = Role::CUSTOMER;
        $users = User::where('role',Role::ADMIN)->where('name','!=','Admin')->paginate(10);
        
        return view('users.index',['users'=>$users,'roles'=>1,'SeAdmin'=>$user,'usersrole'=>$usersrole]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = auth()->user();
        
        return (view('users.create',['SeAdmin'=>$user]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Create Admin
        $sourcename = DB::table('users')->where('name', $request->name)->value('name');
        $sourceemail = DB::table('users')->where('email', $request->email)->value('email');
          
        $formFields = $request->validate([
            
            'phone'=> 'required',
            'password'=> 'required',
            'gmail'=> 'required',
            'email'=> 'required',
            'name'=> 'required',
        ]);

        //     


            if($sourcename==$request->name){
                $msg='Name Oreday Exist';
                return response()->json([
                    'status' => false,
                    'type' => 'name',
                    'error' => $msg,
                ]);
            }
            elseif($sourceemail==$request->email){
                $msg = 'Email Oreday Exist';
                return response()->json([
                    'status' => false,
                    'type' => 'email',
                    'error' => $msg,
                ]);
            }
            else{
                
                $pass = $encrypted = Crypt::encryptString($request->password);
                $user = User::create([
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'gmail'=>$request->gmail,
                    'profile_photo'=>"jjjjjjj",
                    'phone'=>$request->phone,
                    'password'=> $pass,
                    'role'=>Role::ADMIN,
                    'remember_token' => Str::random(10),
                 ]);  
                 
                if($user){
                return response()->json([
                    'status' => true,
                    'msg' => 'Created Successfully',
                ]);}}
           }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $useres = auth()->user();
        
        return view('users.show',['users'=>$user,'SeAdmin'=>$useres]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $useres = auth()->user();
        
        return view('users.edit',['users'=>$user,'SeAdmin'=>$useres]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $formFields = $request->validate([

            'name'=> 'required',
            'email'=> 'required',
            'gmail'=> 'required',
            'password'=> 'required',
            'phone'=> 'required',
        ]);
        //update image
    $role = $request->role;
   
       $edit = $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'gmail'=>$request->gmail,
            'profile_photo'=>Auth::user()->profile_photo,
            'phone'=>$request->phone,
            'password'=> $request->password,
         ]);        
         
        return Redirect::route('users.show',$user->id)->with('status', 'Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $orders = Orders::where('user_id', $request->id)->get();
        $interesteds = Interesteds::where('user_id',$request->id)->get();
        $user = User::find($request->id);
        //delete all
        $user->delete();
        if(isset($orders)){
        foreach ($interesteds as $interested) {
           $interested->delete();
        }}
        if(isset($interesteds)){
        foreach ($orders as $order) {
              $order->delete();
        }}
        return response()->json([
            'status'=>true,
            'msg'=>'Deleted Successfully',
            'id'=>$request->id,
        ]);
    }

   // Start_Pages

   public function Home_SRNZ(){
    
     return view('home-page.Home');

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
        return view('login.login');
    }

    /**
     * @throws ValidationException
     *///check login 
    function checklogin(Request $request)
    {   
        $result = $this->Check($request);
        if (!(Auth::attempt($result->user_data))) {
            return back()->with('error', 'Wrong Login Details');
        }
        if (Auth::user()->role == Role::ADMIN) {
            return view('home-page.admin',['SeAdmin'=>$result->source]);
        }
        if (Auth::user()->role == Role::CUSTOMER) {

            return view('home-page.customer',['SeCustomer'=>$result->source]);

        }
        
        return redirect('/login');
    }

    //logout
    function logout()
    {
        Auth::logout();
        return redirect('Home_SRNZ');
    }

    // return page forget 
    public function forgetindex(){
            return view('login.forget');
    }

      // forget password
      public function forget(Request $request){
        dd($request);
        $result = $this->forgetCheck($request);
        if (!(Auth::attempt($result->user_data))) {
            return back()->with('error', 'Wrong Login Details');
        }
        if (Auth::user()->role == Role::ADMIN) {
            return view('home-page.admin',['SeAdmin'=>$result->source]);
        }
        if (Auth::user()->role == Role::CUSTOMER) {

            return view('home-page.customer',['SeCustomer'=>$result->source]);

        }
        
        return redirect('/login');        
    
    }

    //autocompleteSearch
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 
    
    //search
    public function search_users (Request $request)
     {

        $output = $this->UserSearch($request);
        
       return response($output);
            
         
     }

    
}
