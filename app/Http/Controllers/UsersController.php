<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Interesteds;
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
        $users = User::where('role',Role::CUSTOMER)->paginate(10);
        
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
    public function show(User $user)
    {
        //
        return view('users.show',['users'=>$user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('users.edit',['users'=>$user]);
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
    public function destroy(User $user)
    {
        //
        $orders = Orders::where('user_id', $user->id)->get()->value('id');
        $interesteds = Interesteds::where('user_id',$user->id)->get()->value('id');
        //delete all
      /*  if(isset($interesteds)){
            if(isset($orders)){
                $interesteds->delete();
                $orders->delete();
                $user->delete();
             }
             else{
        $interesteds->delete();}}
        else{
            if(isset($orders)){
               $orders->delete();
               $user->delete();
            }
        }
        */
        if(isset($interesteds)){$interesteds->delete();}else{
            dd('okay');
        }
        if ($orders||$interesteds) {
            return Redirect::route('users.index')->with('status', 'Deleted Successfully, And Delete All Orders & Interesteds for this user.');
        } else {
            return Redirect::route('users.index')->with('status', 'Deleted Successfully.');
        }
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
         if (isset($_POST['search'])) {
             //$_post['search']
             $search=$request->search;
             $users = User::where('name',$search)->paginate(12);
     
             return view('users.index', ['users'=>$users]);
                        
         } 
     }
}
