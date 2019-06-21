<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
//required when you want to use sql query
use DB;

class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //using sql query
       //$posts = DB::select('SELECT * FROM posts');

        //using eloquent to query the database
        //$posts = Post::all();
       //return Post::where('title','Post Two')->get();
       //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        //pagination
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.  
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
            //
        ]);
        /** */
        //handle file upload
       // if($request->hash_file('cover_page')){
            //get file name with extension
         //   $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
         //   $filename= pathInfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
           // $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
        //    $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
        //    $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      /*  }else{
           $fileNameToStore = 'noimage.jpg'; 
        }*/
         $fileNameToStore = 'noimage.jpg'; 
        //create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id= auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
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
       $posts = Post::find($id);
        return view('posts.show')->with('posts',$posts);
       //return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $posts = Post::find($id);
        //check for correct user
        if(Auth()->user()->id !== $post->user_id){
            return view('posts.index')->with('error','Unauthorized access');
        }
        return view('posts.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //
         $this->validate($request, [
            'title'=>'required',
            'body'=>'required'
            //
        ]);
        
        //update post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        //check for correct user
        if(Auth()->user()->id !== $post->user_id){
            return view('posts.index')->with('error','Unauthorized access');
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
