<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 

    public function __construct()
{
    $this->middleware('auth')->except(['index','single']);
}


function mypost(){
    $allPosts = Post::latest()->get();
    return view('blog.mypost',compact('allPosts'));
}

    public function index(Request $request)
    {
     
        if($request->search){
 $allPosts = Post::where('title','like',"%".$request->search."%")->orwhere('body','like',"%".$request->search."%")->latest()->paginate(4);
        }
        elseif($request->category){
          
            $allPosts = Category::where('name', $request->category)->firstOrFail()->posts()->paginate(2)->withQueryString();
 
        }
        else{
            $allPosts = Post::latest()->paginate(4);
        }


       


       
        $fullCategory = Category::all();

    return view('blog.index', compact('allPosts','fullCategory'));
        
    }

    public function single($slug)
    {

        $singlePost = Post::where('slug', $slug)->first();
        $category = $singlePost->category;   
        $relatedPosts = $category->posts()->where('id','!=',$singlePost->id)->latest()->take(2)->get(); 
        return view('blog.single',compact('singlePost','relatedPosts'));
    }


    public function edit(Post $post)
    {
        
        if(auth()->check() && auth()->user()->id !== $post->user->id){
            abort(403);
        }
        $currentID = $post->id;
        $editPost = Post::where('id',$currentID)->first();
        $ddCat = Category::all();
         return view('blog.edit',compact('editPost','ddCat'));
    }





    public function update(Request $request, Post $post)
    {

            if(auth()->check() && auth()->user()->id !== $post->user->id){
                abort(403);
            }

        // dd($post->id);
        $request->validate([
            "title"=> 'required|string', 
             "image"=>'required|image',
             "body"=> 'required',
             "category_id"=> 'required|'
          ]);
    
          $title = $request->input('title');
          $category_id = $request->input('category_id');
          $currentPostID = $post->id;
          $slug = str::slug($title,'-') . "-" .  $currentPostID; 
          $body = $request->input('body');
          $imagePath = 'storage/'.$request->file('image')->store('blog/post/images','public');
    
         
          $post->title = $title;
          $post->slug = $slug;
          $post->category_id = $category_id;
           $post->imagePath = $imagePath;
          $post->body = $body;
          $post->save();
          return redirect()->back()->with('status','Post Updated successfully');
           
    }









    public function create()
    {
        $ddCat = Category::all();
        return view('blog.create',compact('ddCat'));
    }

   
    public function store(Request $request)
    {
     
      $request->validate([
	    "title"=> 'required|string', 
         "image"=>'required|image',
         "body"=> 'required',
         "category_id"=> 'required|'
         
      ]);

      $title = $request->input('title');
      $category_id = $request->input('category_id');

   
      if(Post::latest()->first() === null){
        $LatestPostID =  1;
      }else{
        $LatestPostID = Post::latest()->take(1)->first()->id + 1;
      }

      $slug = str::slug($title,'-') . "-" .  $LatestPostID;
      $userID = Auth::user()->id; 
      $body = $request->input('body');
      $imagePath = 'storage/'.$request->file('image')->store('blog/post/images','public');

      $post = new Post();
      $post->title = $title;
      $post->category_id = $category_id;
      $post->slug = $slug;
      $post->user_id = $userID;
      $post->imagePath = $imagePath;
      $post->body = $body;
      $post->save();
      return redirect()->back()->with('status','Post Saved successfully');
       
     
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
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
    
        $post->delete();
        return redirect()->route('blog.index')->with('status','Post Deleted successfully');
    }
}
