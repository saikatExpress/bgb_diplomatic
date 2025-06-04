<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function store(Request $request)
    {
        $pass = $request->query('password');
        $developerPass = 'HelloDevSaikat' . date('Y');

        if($pass == $developerPass){
            return 1;
        }else{
            return 2;
        }
    }
}