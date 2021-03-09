<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function addTag(Request $request){

        // validation
        $this->validate($request, [
            'tagName' => 'required'
        ]);

        return Tag::create([
            'tagName' => $request->tagName
        ]);

    }
    public function edit_tag(Request $request){

        // validation
        $this->validate($request, [
            'tagName' => 'required',
            'id' => 'required'
        ]);

        return Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);

    }
    public function deleteTag(Request $request){

        // validation
        $this->validate($request, [
            'id' => 'required'
        ]);

        return Tag::where('id', $request->id)->delete();

    }
    // upload images
    public function upload(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png'
        ]);

         $picName = time().'.'.$request->file->extension();

         $request->file->move(public_path('upload'), $picName);

         return $picName;
    }

    public function getTag(){
     
        return Tag::orderBy('id','desc')->get();
    }
    
    public function deleteImage(Request $request){

        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName);

        return 'done';
    }

    public function deleteFileFromServer($fileName){

        $filePath = public_path().'/upload/'.$fileName;
        if(file_exists($filePath)){
            @unlink($filePath);
        }

        return;
    }


    // category
    public function addCategory(Request $request){
        // validation
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImage' => 'required'
        ]);

        return Category::create([
            'categoryName' => $request->categoryName,
            'iconImage' => $request->iconImage
        ]);
    }

    public function getCategory(){
     
        return Category::orderBy('id','desc')->get();
    }


    public function editCategory(Request $request){

        // validation
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImage' => 'required',
            'id' => 'required'
        ]);


        return Category::where('id', $request->id)->update([
            'categoryName' => $request->categoryName,
            'iconImage' => $request->iconImage
        ]);

    }
    public function deleteCategory(Request $request){

        // validation
        $this->validate($request, [
            'id' => 'required'
        ]);

        return Category::where('id', $request->id)->delete();

    }


    // auth

    public function login(){
        return view('auth.login');
    }

    public function getLoginCredentials(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $data['users'] = User::where('email', $request->email)->get();
        $email = $request->email;
  
            // echo $data->email;
        return redirect('/dashboard');
       
    }

}
