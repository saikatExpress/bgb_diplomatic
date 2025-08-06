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
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status', 'active')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function($data){
                    $role = filter($data->role);

                    return $role;
                })
                ->addColumn('status', function($data){
                    $status = filter($data->status);

                    return '<button class="btn btn-sm btn-success">' . $status .'</button>';
                })

                ->addColumn('action', function ($data) {
                    $editRoute = route('user.edit', ['user' => $data->id]);
                    $deleteRoute = route('user.destroy', ['user' => $data->id]);
                    $actionButtons = '
                        <a href="' . $editRoute . '" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger"
                            onclick="showDeleteConfirm(' . $data->id . ', \'' . $deleteRoute . '\')">
                            <i class="fa-solid fa-trash"></i>
                        </button>';
                    return $actionButtons;
                })

                ->rawColumns(['name', 'email', 'role', 'status', 'action'])
                ->make(true);
        }

        return view('setting.partials.user.index');
    }

    public function create()
    {
        return view('setting.partials.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        return User::store($request->validated());
    }

    public function edit(User $user)
    {
        return view('setting.partials.user.edit', compact('user'));
    }

    public function update(updateUserRequest $request, User $user)
    {
        return User::updateData($request->validated(), $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}
