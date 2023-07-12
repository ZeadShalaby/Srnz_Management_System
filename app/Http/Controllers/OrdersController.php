<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Interesteds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $check=Role::ADMIN;
        if($interested){
        return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'check'=>$check]);
        }
        else{
            return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'check'=>$check]);
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
    return view('orders.show',['orders'=>$order]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $order)
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
        if(auth()->user()->role==Role::ADMIN){
        $dep_orders = Interesteds::where('order_id', $order->id)->get()->value('order_id');
        $order->delete();
        if ($dep_orders) {
            $deleted = DB::table('interesteds')->where('order_id', $order->id)->delete();
            return Redirect::route('orders.index')->with('status', 'Deleted Successfully, but there were interesteds in this Orders.');
        } else {
            return Redirect::route('orders.index')->with('status', 'Deleted Successfully.');
        }}

       
    }
    
    //view restore
    public function restore_index()
    {
        return view('trash.orders_restore', ['orders' => Orders::onlyTrashed()->paginate(10)]);
     }
    
    // restore
    public function restore()
    {
       $id = Request()->id;
       Orders::withTrashed()->find($id)->restore();;
       return back()->with('status', 'Orders Restore successfully');
    }
                                                                             

    //autocompleteSearch orders
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Orders::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
        
    }

    //search orders
    public function search_orders (Request $request)
    {
        // 

        if (isset($_POST['searchs'])) {
            //$_POST['search']
            $search=$request->search;
            $orders = Orders::where('name',$search)->paginate(12);
            $interested = interesteds::get();
            $orders_user = Orders::where('user_id', Auth::user()->id)->get();

            $check=Role::ADMIN;
            if(auth()->user()->role==Role::ADMIN){
            return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'check'=>$check,'orders_user'=>$orders_user]);
            }
            else{
                return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'check'=>$check,'orders_user'=>$orders_user,'sefav'=>1]);

            }         
        } 
    }

}