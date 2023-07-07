<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Interesteds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Orders::paginate(10);
        $interested = Interesteds::get();
        if($interested){
        return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id]);
        }
        else{
            return view('orders.index',['orders'=>$orders,'interesteds'=>$interested]);
        }

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
    public function store(Request $request,Orders $order )
    {
        //

        
       

    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $order)
    {
        //
// if(auth()->user()->id==Role::ADMIN){
    return view('orders.show',['orders'=>$order]);//}
//else{
  //  return back()->with("error","not have a perrmation");}

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
    public function destroy(Orders $order)
    {
        //
        $dep_orders = Interesteds::where('order_id', $order->id)->get()->value('order_id');
        $order->delete();
        if ($dep_orders) {
            $deleted = DB::table('interesteds')->where('order_id', $order->id)->delete();
            return Redirect::route('orders.index')->with('status', 'Deleted Successfully, but there were interesteds in this department.');
        } else {
            return Redirect::route('orders.index')->with('status', 'Deleted Successfully.');
        }
    }
    
    //view restore
    public function restore_index()
    {
        return view('trash.orders_restore', ['orders' => Orders::onlyTrashed()->get()]);
    }
    
    // restore
    public function restore()
    {
       $id = Request()->id;
       Orders::withTrashed()->find($id)->restore();;
       return back()->with('status', 'Orders Restore successfully');
    }
    //favourite

    public function favoruite(Request $request){

        if (isset($_POST['favourite'])) {
            $order_id=$_POST['id'];
            $check_order = interesteds::where('order_id', $order_id)->where('user_id',auth()->user()->id)->get();
            if($check_order){
            foreach ($check_order as $check) {
            if(($check->user_id == auth()->user()->id)&($check->order_id == $order_id)){
                //delete
            return back()->with('faverror',"Alredy Aded Favourite");}}}
                $formFields = interesteds::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order_id,
            ]);
            return back()->with('favourite',$order_id); 
}}
                                                      
                            
     //autocompleteSearch restore
     public function autocompleteSearch_restore(Request $request)
     {
        $query = $request->get('query');
        $filterResult = Orders::where('name', 'LIKE', '%'. $query. '%')->onlyTrashed()->get();
        return response()->json($filterResult);
           
     }

    //autocompleteSearch
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Orders::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
        
    }

    //search
    public function search_orders (Request $request)
    {
        if (isset($_POST['searchs'])) {
            $search=$_POST['search'];
            $orders = Orders::where('name',$search)->paginate(12);
            $interested = interesteds::get();

            return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id]);
                       
        } 

        if (isset($_POST['favourite'])) {
            $order_id=$_POST['id'];
            $check_order = interesteds::where('order_id', $order_id)->where('user_id',auth()->user()->id)->get();
            if($check_order){
            foreach ($check_order as $check) {
            if(($check->user_id == auth()->user()->id)&($check->order_id == $order_id)){
                //delete
            return back()->with('faverror',"Alredy Aded Favourite");}}}
                $formFields = interesteds::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order_id,
            ]);
            return back()->with('favourite',$order_id); 
}
    }

    //search restore
    public function search_orders_restore (Request $request)
    {
        if (isset($_POST['searchs_restore'])) {
            $search=$_POST['search'];
            $orders = Orders::where('name',$search)->onlyTrashed()->get();
            $interested = interesteds::get();

            return view('trash.orders_restore',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id]);
                       
        } 

        if (isset($_POST['favourite_restore'])) {
            $order_id=$_POST['id'];
            $check_order = interesteds::where('order_id', $order_id)->where('user_id',auth()->user()->id)->get();
            if($check_order){
            foreach ($check_order as $check) {
            if(($check->user_id == auth()->user()->id)&($check->order_id == $order_id)){
                //delete
            return back()->with('faverror',"Alredy Aded Favourite");}}}
                $formFields = interesteds::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order_id,
            ]);
            return back()->with('favourite',$order_id); 
}
    }
}