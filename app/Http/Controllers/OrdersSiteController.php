<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Traits\ImgTrait;
use App\Models\Departments;
use App\Models\Interesteds;
use App\Events\OrderVieweer;
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
        $useres = auth()->user();
        $orders = Orders::paginate(10);
        $interested = Interesteds::get();
        $orders_user = Orders::where('user_id', Auth::user()->id)->get();
        $departments = Departments::get();
      //  dd($orders_user);
        if($interested){
        return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id,'orders_user'=>$orders_user,'SeCustomer'=>$useres,'Departments'=>$departments]);
        }
        else{
            return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'orders_user'=>$orders_user,'SeCustomer'=>$useres,'Departments'=>$departments]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $useres = auth()->user();
        $departments = Departments::get();
        return view('ordersite.create',['departments'=>$departments,'SeCustomer'=>$useres]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([

            'path'=> 'required|image|mimes:jpg,png,gif|max:2048',
            'price'=> 'required',
            'description'=> 'required',
            'department_id'=> 'required',
            'name'=> 'required',

        ]);
        

        if (!isset(auth()->user()->phone)) {
            $msg= 'please update setting first (add your phone to show your orders and connect  with other people) .';
            return back()->with('important',$msg);}
        else{
        //save image (Departments) in folder 
        $folder = 'image/orders';
        $file_name = $this->saveImage($request->path,$folder);
        $name = $request->name;
        $sename = DB::table('orders')->where('name', $name)->value('id');  

        if($sename>0){
            $msg= 'Name Oredy Eists .';
           return back()->with('error',$msg);
        }
       else{
            $order = Orders::create([
                'name'=> $request->name,
                'department_id'=> $request->department_id,
                'user_id'=>Auth::user()->id,
                'gmail'=>Auth::user()->gmail,
                'phone'=>Auth::user()->phone,
                'description'=> $request->description,
                'price'=> $request->price,
                'path'=> $file_name,
    
             ]);
            if($order){
                $msg= 'Create successfuly .';

                return back()->with('status',$msg);

            }
            }}
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $ordersite)
    {
            $useres = auth()->user();
            // view eyes
            $view = $ordersite;//Orders::first();
            event(new OrderVieweer($view));
            //show
            return view('ordersite.show',['orders'=>$ordersite,'interesteds'=>Interesteds::get(),'userid'=>auth()->user()->id,'SeCustomer'=>$useres]);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $ordersite)
    {
        //
        $useres = auth()->user();
        $departments = Departments::get();
        return view('ordersite.edit', ['orders' => $ordersite,'departments'=>$departments,'SeCustomer'=>$useres]);

    }

    /**
     * Update the specified resource in storage.
     */ //=>'required|image|mimes:jpg,png,gif|max:2048'
    public function update(Request $request, Orders $ordersite)
    {
        

        $formFields = $request->validate([
            'name'=> 'required',
            'department_id'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'path',
        ]);

        //update image
        $folder = 'image/orders';
        if(!isset($request->path)){
            $file_name = $ordersite->path;
        }
       else{
        $file_name = $this->saveImage($request->path,$folder);
       }
       
        //update
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
  
    public function destroy(Request $request)
    {
        //
        $order = Orders::find($request->id);
        $dep_interesteds = Interesteds::where('order_id', $request->id)->where('user_id',auth()->user()->id)->get();
        $order->delete();
        if(isset($dep_interesteds)){
        foreach ($dep_interesteds as $interested) {
            $interested->delete();
       }}
        return response()->json([
            'status' => true,
            'msg'=>'Deleted Successfully.',
            'id'=>$request->id,
        ]);     

    }

    //favourite
    public function favoruite(Request $request){

           //$_POST['id']
             $order_id=$request->id;
            $check_order = interesteds::where('order_id', $order_id)->where('user_id',auth()->user()->id)->get();
            if($check_order)
            foreach ($check_order as $check) 
            if(($check->user_id == auth()->user()->id)&($check->order_id == $order_id))
                //$favdelete = $check->id->delete();}}}
            return response()->json([
                'staus'=>false,
                'msg'=>"Alredy Aded Favourite",
                'type'=>'red',
            ]);
           
                $formFields = interesteds::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order_id,
            ]);

            return response()->json([
                'status'=>true,
                'msg'=>'Added successfully',
                'id'=>$order_id,
                'type'=>'red',
            ]);

        }

    //view restore
    public function restore_index_site()
    {
        $useres = auth()->user();
        $orders_restore = Orders::where('user_id',auth()->user()->id)->onlyTrashed()->paginate(10);
        return view('trash.orders_restore_site', ['orders' => $orders_restore,'SeCustomer'=>$useres]);
    }
    
    // restore
    public function restore_site(Request $request)
    {
    
       $id = $request->id;
       Orders::withTrashed()->find($id)->restore();
       
       return response()->json([
            'status' => true,
            'msg'=>'Orders Restore successfully .',
            'id'=>$request->id,
       ]);

    }

    

   
}
