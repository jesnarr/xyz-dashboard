<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function getRecords(){
        return Record::orderBy('id','desc')->get();
    }

    public function addRecord(Request $request){

      
        // validation
        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'civil_status' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'purok' => 'required'
        ]);
        
      
        return Record::create([
            'name' => $request->name,
            'dob' => date('Y-m-d',strtotime($request->dob)),
            'civil_status' => $request->civil_status,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'purok' => $request->purok,
            'educational_attainment' => $request->educational_attainment,
            'occupation' => $request->occupation,
            'spouse_name' => $request->spouse_name,
            'category' => $request->category,
        ]);

    }

    public function edit_Record(Request $request){
        // validation
        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'civil_status' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'purok' => 'required'
        ]);

        return Record::where('id', $request->id)->update([
            'name' => $request->name,
            'dob' => date('Y-m-d',strtotime($request->dob)),
            'civil_status' => $request->civil_status,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'purok' => $request->purok,
            'educational_attainment' => $request->educational_attainment,
            'occupation' => $request->occupation,
            'spouse_name' => $request->spouse_name,
            'category' => $request->category,
        ]);

    }
    public function deleteRecord(Request $request){

        // validation
        $this->validate($request, [
            'id' => 'required'
        ]);

        return Record::where('id', $request->id)->delete();

    }
}
