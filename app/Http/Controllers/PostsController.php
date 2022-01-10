<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['show','index']]);
    }


    public function index()
    {   
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->get();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        

        $file_name_to_store = 'noimage.jpg';

        if($request->hasFile('cover_image')){
            
            //Complete Name of the file with extension
            $completeFileName = $request->file('cover_image')->getClientOriginalName();

            //Only the file name
            $filename = pathinfo($completeFileName,PATHINFO_FILENAME);

            //Only the extension
            $file_extension = $request->file('cover_image')->getClientOriginalExtension();

            //File name to store
            $file_name_to_store = $filename.'_'.time().'.'.$file_extension;

            $path = $request->file('cover_image')->storeAs('public/cover_images',$file_name_to_store);

        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $file_name_to_store;
        $post->user_id = auth()->user()->id;
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
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
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
           
         //if the user is trying to access illlegaly then redirect
         if(auth()->user()->id!==$post->user_id)
            return redirect('/home')->with('error','Unauthorized access');
        
         return view('posts.edit')->with('post',$post);
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

        $post = Post::find($id);
        
        //if the user is trying to access illlegaly then redirect
        if(auth()->user()->id!==$post->user_id)
            return redirect('/home')->with('error','Unauthorized access');

            $this->validate($request,[
                'title'=>'required',
                'body'=>'required',
                'cover_image'=>'image|nullable|max:1999'
            ]);
            
    
            $file_name_to_store = 'noimage.jpg';
    
            if($request->hasFile('cover_image')){
                
                //Complete Name of the file with extension
                $completeFileName = $request->file('cover_image')->getClientOriginalName();
    
                //Only the file name
                $filename = pathinfo($completeFileName,PATHINFO_FILENAME);
    
                //Only the extension
                $file_extension = $request->file('cover_image')->getClientOriginalExtension();
    
                //File name to store
                $file_name_to_store = $filename.'_'.time().'.'.$file_extension;
    
                $path = $request->file('cover_image')->storeAs('public/cover_images',$file_name_to_store);
    
            }    

        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $file_name_to_store;
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
        // delete the post
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');
    }
}
