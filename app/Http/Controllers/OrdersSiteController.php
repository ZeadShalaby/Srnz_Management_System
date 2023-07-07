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
        if($interested){
        return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested,'userid'=>auth()->user()->id]);
        }
        else{
            return view('ordersite.index',['orders'=>$orders,'interesteds'=>$interested]);
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
    public function show(Orders $order)
    {
        //
            return view('ordersite.show',['orders'=>$order]);
       
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
}
