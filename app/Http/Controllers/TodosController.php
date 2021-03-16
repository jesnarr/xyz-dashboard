<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    //

     //
     public function index()
     {
         //
         return response()->json(['results' => Todo::paginate(15)]);
     }
 
     public function add_Todo(Request $request){
 
   
     
             // userId ??
        
             return Todo::create([
             'title' => $request->title,
             'userId' => rand(1,10)
         ]);
 
 
     }
 
     public function edit_Todo(Request $request){
 
         return Todo::where('id', $request->id)->update([
             'title' => $request->title,
         ]);
 
     }
   
 
 
     public function delete_Todo(Request $request){
 
     
 
         return Todo::where('id', $request->id)->delete();
 
     }
}
