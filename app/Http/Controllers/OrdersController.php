<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\interesteds;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Orders::paginate(10);
        $interested = interesteds::get()->where('user_id',1)->value('user_id');

        if($interested>0){
        return view('orders.index',['orders'=>$orders,'colors'=>$interested])->with('all-favourites',$interested);
        }
        else{
            return view('orders.index',['orders'=>$orders]);
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

    //favourite

    public function favoruite(Request $request){

    
        if (isset($_POST['favourite'])) {
            $order_id=$_POST['id'];
            $formFields = interesteds::create([
                'user_id' => '1',
                'order_id' => $order_id,
            ]);
        
            return back()->with('favourite',$order_id);
        }
        else{
            $order_id=0;
            return back()->with('favourite',$order_id);

        }
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
    
            return view('orders.index', ['orders'=>$orders]);
                       
        } 
    }
}