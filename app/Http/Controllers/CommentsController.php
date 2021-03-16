<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function index()
    {
        //
        return response()->json(['results' => Comment::paginate(15)]);
    }

    public function add_Comment(Request $request){

  
    
            // userId ??
       
            return Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body,
            'postId' => rand(1,10)
        ]);


    }

    public function edit_Comment(Request $request){

        return Comment::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body,
        ]);

    }
  


    public function delete_Comment(Request $request){

    

        return Comment::where('id', $request->id)->delete();

    }
}
