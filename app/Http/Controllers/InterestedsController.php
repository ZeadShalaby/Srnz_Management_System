<?php

namespace App\Http\Controllers;

use App\Traits\CountTrait;
use App\Models\Orders;
use App\Models\Interesteds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InterestedsController extends Controller
{
    use CountTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $useres = auth()->user();
        $favourite = Interesteds::where('user_id',auth()->user()->id)->get();
        $numfav = $this->countfavourite($favourite);
        $interesteds = Interesteds::where('user_id',Auth::user()->id)->get();
        return view('interesteds.index',['interesteds' => $interesteds,'user_id'=>auth()->user(),'SeCustomer'=>$useres,'countcheck'=>$numfav]);
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
        $useres = auth()->user();
        return Redirect::route('ordersite.show',$interested->order_id,['SeCustomer'=>$useres]);
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
    public function destroy(Request $request)
    {
        //
        $interested = Interesteds::find($request->id);
        if(isset($request->removeall_btn))
        {

            $user_interested = Interesteds::where('user_id',Auth::user()->id)->get();
            if(isset($user_interested)){
          foreach($user_interested as $delete){
          $delete->delete();}
           return response()->json([
            'status'=>true,
            'msg'=>'Remove AllFavourite Successfully .',
            'done'=>true,
           ]);
        }
          else{
            return response()->json([
                'status'=>true,
                'msg'=>'Error Nothing to remove it .',
                'done'=>true,
               ]);

          }
        }

        $interested->delete();
        return response()->json([
            'status'=>true,
            'msg'=>'Favourite Remove successfully .',
            'id'=>$request->id,
            'name'=>$interested->order->name,
        ]);
    }
}
