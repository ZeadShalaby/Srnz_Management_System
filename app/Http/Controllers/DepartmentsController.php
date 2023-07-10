<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Traits\ImgTrait;
use App\Models\Departments;
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
        $departments=Departments::paginate(10);
        return view('departments.index',['departments' => $departments]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('departments.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $formFields = $request->validate([

            'name' => 'required',
            'code' => 'required',
            'img'  => 'required|image|mimes:jpg,png,gif|max:2048',

        ]);


        //save image (Departments) in folder 
        $folder = 'image/departments';
        $file_name = $this->saveImage($request->img,$folder);
       
        $name = $request->name;
        $code = $request->code;
        $sename = DB::table('departments')->where('name', $name)->value('id');  
        $secode = DB::table('departments')->where('code', $code)->value('id');  

        if($sename>0){
            return back()->with('danger', 'Name Oreday Exist');
        }
        if($secode>0){
            return back()->with('danger', 'Code Oreday Exist');

        }
       else{
             Departments::create([
            'name' => $request->name,
            'code' => $request->code,
            'img'  => $file_name ,
             ]);}
        
        return Redirect::route('departments.index')->with('status', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departments $department)
    {
        //
         return view('departments.show',['departments'=>$department]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departments $department)
    {
        return view('departments.edit', ['departments' => $department]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Departments $department)
    {

        $formFields = $request->validate([

            'name' => 'required',
            'code' => 'required',
            'img'  => 'required|image|mimes:jpg,png,gif|max:2048',

        ]);

        //update img
        //update image
        $folder = 'image/departments';
        $file_name = $this->saveImage($request->img,$folder);
        
        

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
    public function destroy(Departments $department)
    {
        //
        $dep_orders = Orders::where('department_id', $department->id)->get()->value('department_id');
        $department->delete();
        if ($dep_orders) {
            return Redirect::route('departments.index')->with('status', 'Deleted Successfully, but there were courses in this department.');
        } else {
            return Redirect::route('departments.index')->with('status', 'Deleted Successfully.');
        }
    }
    
    //view restore
    public function restore_index()
    {
        return view('trash.departments_restore', ['departments' => Departments::onlyTrashed()->get()]);
    }
    
    //restore
    public function restore()
    {
       $id = Request()->id;
       Departments::withTrashed()->find($id)->restore();;
       return back()->with('status', 'Departments Restore successfully');
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
         if (isset($_POST['search'])) {
             $search=$request->search;
             $deoartments = Departments::where('name',$search)->paginate(12);
     
             return view('departments.index', ['departments'=>$deoartments]);
                        
         } 
     }
   
}
