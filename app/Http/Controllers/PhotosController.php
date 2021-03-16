<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    //

    public function index()
    {
        //
        return response()->json(['results' => Photo::paginate(15)]);
    }

    public function add_Photo(Request $request){

  
    
            // userId ??
       
            return Photo::create([
                'title' => $request->title,
                'url' => $request->url,
                'thumbnailUrl' => $request->thumbnailUrl,
                'albumId' => rand(1,10)
        ]);


    }

    public function edit_Photo(Request $request){

        return Photo::where('id', $request->id)->update([
            'title' => $request->title,
            'url' => $request->url,
            'thumbnailUrl' => $request->thumbnailUrl,
        ]);

    }
  


    public function delete_Photo(Request $request){

    

        return Photo::where('id', $request->id)->delete();

    }
}
