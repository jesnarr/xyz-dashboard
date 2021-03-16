<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function index()
    {
        //
        return response()->json(['results' => User::paginate(15)]);
    }

    public function add_User(Request $request){

  
    
            // userId ??

            $data = array('name' => $request->company_name,'catchPhrase' => $request->catchPhrase,'bs'=>$request->bs);
            $data2 = array('street' => $request->street,'suite' => $request->suite,'city'=>$request->city,
            'zipcode'=>$request->zipcode,'geo'=>array('lat'=>$request->lat,'lng'=>$request->lng));

            $company = json_encode($data);
            $address = json_encode($data2);

            return User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'website' => $request->website,
                'thumbnailUrl' => $company,
                'address'=>$address
                
        ]);


    }

    public function edit_User(Request $request){


        
        $data = array('name' => $request->company_name,'catchPhrase' => $request->catchPhrase,'bs'=>$request->bs);
        $data2 = array('street' => $request->street,'suite' => $request->suite,'city'=>$request->city,
        'zipcode'=>$request->zipcode,'geo'=>array('lat'=>$request->lat,'lng'=>$request->lng));
        
        $company = json_encode($data);
        $address = json_encode($data2);

        return User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'website' => $request->website,
            'thumbnailUrl' => $company,
            'address'=>$address
        ]);

    }
  


    public function delete_User(Request $request){

    

        return User::where('id', $request->id)->delete();

    }
}
