<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $allCategory = Category::all();
        return view('categories.index',compact('allCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
     
        $request->validate([
            "name"=> 'required|unique:categories,name', 
           ]);
    
          $name = $request->input('name');
     
          $Category = new Category();
          $Category->name = $name; 
          $Category->save();
          return redirect()->back()->with('status','Category Saved successfully');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $cat)
    {
        
        
        $currentCatID = $cat->id;
        $editCat = Category::where('id',$currentCatID)->first();
        return view('categories.edit',compact('editCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $editCat)
    {
         

    // dd($post->id);
    $request->validate([
        "name"=> 'required|string' 
      ]);

      $name = $request->input('name'); 
      $editCat->name = $name;
      $editCat->save();
      return redirect()->back()->with('status','Category Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $cat)
    {
    
        $cat->delete();
        return redirect()->route('category.index')->with('status','Category Deleted successfully');
    }
}
