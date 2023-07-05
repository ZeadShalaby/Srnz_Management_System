<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $posts = posts::get();
        if($request->has('view_deleted'))
        {
            posts::onlyTrashed()->get();              
        }

        return view('posts.index', compact('posts'));
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
    public function show(string $id)
    {
        //
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
    public function destroy($id)
    {
        //
        Posts::find($id)->delete();

        return back()->with('success', 'Post Deleted successfully');
   
    }

    public function restore($id)
    {
        Posts::withTrashed()->find($id)->restore();

        return back()->with('success', 'Post Restore successfully');
    }

    public function restore_all()
    {
        Posts::onlyTrashed()->restore();

        return back()->with('success', 'All Post Restored successfully');
    }
}
