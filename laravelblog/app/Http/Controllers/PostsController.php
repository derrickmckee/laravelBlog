<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('created_at', 'desc')->get();
        $posts = DB::select('SELECT * FROM posts ORDER BY created_at DESC');
        return(view('posts.index')->with('posts', $posts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return(view('posts.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999'    // max:2MB
        ]);

        // FileUploadHandler
        if($request->hasFile('cover_img')) {
            //get filename w/ extension
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('cover_img')->getClientOriginalExtension();
            //filename to store in DB
            $time = time();
            $fileNameToStore = "{$filename}_{$time}.{$extension}";
            //UPLOAD IMAGE
            $path = $request->file('cover_img')->storeAs('public/cover_img', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.png';
        }
        

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_img = $fileNameToStore;
        $post->save();

        return(redirect('posts')->with('success', 'Post created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post) 
            return(view('posts.show')->with('post', $post));
        return(redirect('/posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check if user is LOGGED_IN
        if(auth()->user()->id !== $post->user_id){
            return( redirect('/posts')->with('error','Unauthorized Page'));
        }


        
      
        return(view('posts.edit')->with('post', $post));
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999'    // max:2MB
        ]);

        // FileUploadHandler
        if($request->hasFile('cover_img')) {
            //get filename w/ extension
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('cover_img')->getClientOriginalExtension();
            //filename to store in DB
            $time = time();
            $fileNameToStore = "{$filename}_{$time}.{$extension}";
            //UPLOAD IMAGE
            $path = $request->file('cover_img')->storeAs('public/cover_img', $fileNameToStore);

        }

        // commit
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_img')) {
            $post->cover_img = $fileNameToStore;
        }
        $post->save();

        return(redirect('home')->with('success', 'Post Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //check if user is LOGGED_IN
        if(auth()->user()->id !== $post->user_id){
            return( redirect('/posts')->with('error','Unauthorized Page'));
        }

        //DELETE RAW cover img file  /storage/cover_img
        if($post->cover_img!='noimage.png'){
            Storage::delete('public/cover_img/'.$post->cover_img);
        }

        $post->delete();
        return(redirect('/home')->with('success','Post Removed'));
    }
}
