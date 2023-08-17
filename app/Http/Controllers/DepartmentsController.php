<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Orders;
use App\Traits\ImgTrait;
use App\Models\Departments;
use App\Models\Interesteds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DepartmentsController extends Controller
{
    use ImgTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $useres = auth()->user();

        $departments=Departments::paginate(10);
        return view('departments.index',['departments' => $departments,'SeAdmin'=>$useres]);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $useres = auth()->user();
        return view('departments.create',['SeAdmin'=>$useres]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $formFields = $request->validate([

            'img'  => 'required|image|mimes:jpg,png,gif|max:2048',
            'code' => 'required',
            'name' => 'required',


        ]);


        //save image (Departments) in folder 
        $folder = 'image/departments';
        $file_name = $this->saveImage($request->img,$folder);
       
        $name = $request->name;
        $code = $request->code;
        $sename = DB::table('departments')->where('name', $name)->value('id');  
        $secode = DB::table('departments')->where('code', $code)->value('id');  

        if($sename>0){
            $msg='Name Oreday Exist';
            return response()->json([
                'status' => false,
                'type' => 'name',
                'error' => $msg,
            ]);
        }
        if($secode>0){
            $msg = 'Code Oreday Exist';
            return response()->json([
                'status' => false,
                'type' => 'code',
                'error' => $msg,
            ]);
        }
       else{
            $department = Departments::create([
            'name' => $request->name,
            'code' => $request->code,
            'img'  => $file_name ,
             ]);
      if($department){
        return response()->json([
            'status' => true,
            'msg' => 'Created Successfully',
        ]);}
            }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Departments $department)
    {
        //
        $useres = auth()->user();
         return view('departments.show',['departments'=>$department,'SeAdmin'=>$useres]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departments $department)
    {
        $useres = auth()->user();
        return view('departments.edit', ['departments' => $department,'SeAdmin'=>$useres]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Departments $department)
    {

        $formFields = $request->validate([

            'name' => 'required',
            'code' => 'required',
            //'img'  => 'required|image|mimes:jpg,png,gif|max:2048',

        ]);

        //update img
        //update image
        $folder = 'image/departments';
        if(!isset($request->img)){
            $file_name = $department->img;
        }
       else{
        $file_name = $this->saveImage($request->img,$folder);
       }
        

        $department->update([
            'name' => $request->name,
            'code' => $request->code,
            'img'  => $file_name ,
             ]);
        return Redirect::route('departments.show', $department->id)->with('status', 'Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $dep_orders = Orders::where('department_id', $request->id)->get()->value('department_id');
        $department = Departments::find($request->id);
        $department->delete();
        return response()->json([
            'status' => true,
            'msg'=>'Delete successfully .',
            'id'=>$request->id,
        ]);
    }
    
    //view restore
    public function restore_index()
    {
        $useres = auth()->user();
        return view('trash.departments_restore', ['departments' => Departments::onlyTrashed()->paginate(10),'SeAdmin'=>$useres]);
    }
    
    //restore
    public function restore(Request $request)
    {
       $id = $request->id;
       Departments::withTrashed()->find($id)->restore();
       return response()->json([
        'status' => true,
        'msg'=>'Departments Restore successfully .',
        'id'=>$request->id,
       ]);

    }
     
    //autocompleteSearch
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Departments::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 
    
    //search
    public function search_departments (Request $request)
     {
        $output = $this->DepSearch($request);
        
        return response($output);
     }
   
}
