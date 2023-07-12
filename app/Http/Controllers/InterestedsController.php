<?php

namespace App\Http\Controllers;

use App\Models\Interesteds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InterestedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $interesteds = Interesteds::where('user_id',Auth::user()->id)->paginate(5);
        return view('interesteds.index',['interesteds' => $interesteds,'user_id'=>auth()->user()]);
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
    public function show(Interesteds $interested)
    {
        //
       // $orders = DB::table('orders')->where('id',$interested->order_id)->get();
        return Redirect::route('ordersite.show',$interested->order_id);
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
    public function destroy(Interesteds $interested)
    {
        //
        if(isset($_POST['deleteall']))
        {
            $user_interested = Interesteds::where('user_id',Auth::user()->id)->value('user_id');
            if($user_interested){
          $deleteall = Interesteds::where('user_id',Auth::user()->id)->get();
          foreach($deleteall as $delete){
          $delete->delete();}
          return Redirect::route('interesteds.index')->with('deleteall', 'Remove AllFavourite Successfully.');
          }
          else{
            return Redirect::route('interesteds.index')->with('error', 'Error Nothing to remove it.');

          }
        }
        $interested->delete();
        return Redirect::route('interesteds.index')->with('status', 'Remove Favourite Successfully.');
    }
}
