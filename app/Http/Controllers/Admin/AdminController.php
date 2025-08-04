<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\updateUserRequest;
use Illuminate\Support\Facades\File;
use Spatie\Backup\Events\BackupHasFailed;

class AdminController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('setting.partials.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        return $request->validated();
    }
}