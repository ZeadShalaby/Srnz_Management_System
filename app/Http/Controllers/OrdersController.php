<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Traits\ImgTrait;
use App\Models\Departments;
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
    use ImgTrait;

    public function index()
    {
        //
        $useres = auth()->user();
        $orders = Orders::paginate(10);
        $interested = Interesteds::get();
        $check=Role::ADMIN;
        $departments = Departments::get();
        if($interested){
        return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'check'=>$check,'SeAdmin'=>$useres,'Departments'=>$departments]);
        }
        else{
            return view('orders.index',['orders'=>$orders,'interesteds'=>$interested,'check'=>$check,'SeAdmin'=>$useres,'Departments'=>$departments]);
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
    public function show(orders $order)
    {
        //
        $useres = auth()->user();

    return view('orders.show',['orders'=>$order,'SeAdmin'=>$useres]);


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
    public function destroy(Request $request)
    {
        //
        if(auth()->user()->role==Role::ADMIN){
        $order = Orders::find($request->id);    
        $dep_orders = Interesteds::where('order_id', $request->id)->get()->value('order_id');
        $order->delete();
        if ($dep_orders) {
            $deleted = DB::table('interesteds')->where('order_id', $request->id)->delete();
            //response to Ajax With Json
            return response()->json([
                'status' => true,
                'msg'=>'Deleted Successfully.',
                'id'=>$request->id,
            ]);
        } else {
            return response()->json([
                'status' => true,
                'msg'=>'Deleted Successfully.',
                'id'=>$request->id,
            ]);       
         }}

        
    }
    
    //view restore
    public function restore_index()
    {
        $useres = auth()->user();
        return view('trash.orders_restore', ['orders' => Orders::onlyTrashed()->paginate(9),'SeAdmin'=>$useres]);
     }
    
    // restore
    public function restore(Request $request)
    {
       $id = $request->id;
       Orders::withTrashed()->find($id)->restore();

       return response()->json([
        'status' => true,
        'msg'=>'Orders Restore successfully .',
        'id'=>$request->id,
   ]);
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
            $output = $this->OrSearch($request);

            
            return response($output);     
        
    }
}
