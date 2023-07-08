<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Traits\ImgTrait;
use App\Models\Interesteds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrdersSiteController extends Controller
{
    use ImgTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Orders::paginate(10);
        $interested = Interesteds::get();
        $orders_user = Orders::where('user_id', Auth::user()->id)->get();
      //  dd($orders_user);
        if($interested){
        return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'orders_user'=>$orders_user]);
        }
        else{
            return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'orders_user'=>$orders_user]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ordersite.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([

            'name'=> 'required',
            'department_id'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'path'=> 'required|image|mimes:jpg,png,gif|max:2048',

        ]);


        //save image (Departments) in folder 
        $folder = 'image/orders';
        $file_name = $this->saveImage($request->path,$folder);
        $name = $request->name;
        $sename = DB::table('orders')->where('name', $name)->value('id');  

        if($sename>0){
            return back()->with('danger', 'Name Order Oreday Exist');
        }
       else{
             Orders::create([
                'name'=> $request->name,
                'department_id'=> $request->department_id,
                'user_id'=>Auth::user()->id,
                'gmail'=>Auth::user()->gmail,
                'phone'=>Auth::user()->phone,
                'description'=> $request->description,
                'price'=> $request->price,
                'path'=> $file_name,
    
             ]);}
        
        return Redirect::route('ordersite.index')->with('status', 'Created Successfully');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $ordersite)
    {
        //
            return view('ordersite.show',['orders'=>$ordersite]);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $ordersite)
    {
        //
       
        return view('ordersite.edit', ['orders' => $ordersite]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $ordersite)
    {
        $formFields = $request->validate([

            'name'=> 'required',
            'department_id'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'path'=> 'required|image|mimes:jpg,png,gif|max:2048',

        ]);

        //update image
        $folder = 'image/orders';
        $file_name = $this->saveImage($request->path,$folder);
       
        $ordersite->update([
            'name'=> $request->name,
            'department_id'=> $request->department_id,
            'user_id'=>Auth::user()->id,
            'gmail'=>Auth::user()->gmail,
            'phone'=>Auth::user()->phone,
            'description'=> $request->description,
            'price'=> $request->price,
            'path'=> $file_name,
         ]);        
         
        return Redirect::route('ordersite.show',$ordersite->id)->with('status', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
  
    public function destroy(Orders $ordersite)
    {
        //
        $dep_orders = Interesteds::where('order_id', $ordersite)->where('user_id',auth()->user()->id)->get()->value('order_id');
        $ordersite->delete();
        if ($dep_orders) {
            $dep_orders ->delete();
            return Redirect::route('ordersite.index')->with('status', 'Deleted Successfully, but there were courses in this orders.');
        } else {
            return Redirect::route('ordersite.index')->with('status', 'Deleted Successfully.');
        }

       

    }

    //favourite
    public function favoruite(Request $request){

        if (isset($_POST['favourite'])) {
            //$_POST['id']
            $order_id=$request->id;
            $check_order = interesteds::where('order_id', $order_id)->where('user_id',auth()->user()->id)->get();
            if($check_order){
            foreach ($check_order as $check) {
            if(($check->user_id == auth()->user()->id)&($check->order_id == $order_id)){
                //            $favdelete = $check->id->delete();}}}

            return back()->with('faverror',"Alredy Aded Favourite");}}}
                $formFields = interesteds::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order_id,
            ]);
            return back()->with('favourite',$order_id); 
    }}

    //view restore
    public function restore_index_site()
    {
      
        $orders_restore = Orders::where('user_id',auth()->user()->id)->onlyTrashed()->get();
        return view('trash.orders_restore_site', ['orders' => $orders_restore]);
    }
    
    // restore
    public function restore_site()
    {
       $id = Request()->id;
       Orders::withTrashed()->find($id)->restore();;
       return back()->with('status', 'Orders Restore successfully');
    }

}
