<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function getReports(){
        return Report::orderBy('id','desc')->get();
    }

    public function addReport(Request $request){

        // validation
        $this->validate($request, [
            'name' => 'required',
            'respondent' => 'required',
            'reason' => 'required',
            'place' => 'required',
            'time' => 'required',
            'date' => 'required'
        ]);

        return Report::create([
            'name' => $request->name,
            'respondent' => $request->respondent,
            'reason' => $request->reason,
            'place' => $request->place,
            'time' => $request->time,
            'date' => $request->date
        ]);

    }

    public function edit_Report(Request $request){
        // validation
        $this->validate($request, [
            'name' => 'required',
            'respondent' => 'required',
            'reason' => 'required',
            'place' => 'required',
            'time' => 'required',
            'date' => 'required'
        ]);

        return Report::where('id', $request->id)->update([
            'name' => $request->name,
            'respondent' => $request->respondent,
            'reason' => $request->reason,
            'place' => $request->place,
            'time' => $request->time,
            'date' => $request->date
        ]);

    }
    public function deleteReport(Request $request){

        // validation
        $this->validate($request, [
            'id' => 'required'
        ]);

        return Report::where('id', $request->id)->delete();

    }
}
