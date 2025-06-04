<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('dev.partials.dashboard');
    }

    public function create()
    {
        return view('dev.auth.login');
    }

    public function store(Request $request)
    {
        $email = trim($request->input('email'));
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $pass = $request->input('password');

        $developerPass = 'HelloDevSaikat' . date('d').date('D').date('Y');

        if($pass == $developerPass && $email == config('dev.email')){
            return redirect()->route('developer.index');
        }
    }
}