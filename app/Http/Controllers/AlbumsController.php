<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    //
    public function index()
    {
        //
        return response()->json(['results' => Album::paginate(15)]);
    }

    public function add_Album(Request $request){

  
    
            // userId ??
       
            return Album::create([
            'title' => $request->title,
            'userId' => rand(1,10)
        ]);


    }

    public function edit_Album(Request $request){

        return Album::where('id', $request->id)->update([
            'title' => $request->title,
        ]);

    }
  


    public function delete_Album(Request $request){

    

        return Album::where('id', $request->id)->delete();

    }
}
