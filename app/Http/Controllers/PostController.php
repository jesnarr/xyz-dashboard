<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(['results' => Post::latest()->paginate(15)]);
    }

    public function add_Post(Request $request){

  
    
            // userId ??
       
            return Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'userId' => rand(1,10)
        ]);


    }

    public function edit_Post(Request $request){

        return Post::where('id', $request->id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

    }
  


    public function delete_Post(Request $request){

    

        return Post::where('id', $request->id)->delete();

    }
}
