<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'msg' => 'this is a message'
        ]);
    }
    public function test(){
        return response()->json([
            'msg' => 'this is a message',
        ]);
    }
}
