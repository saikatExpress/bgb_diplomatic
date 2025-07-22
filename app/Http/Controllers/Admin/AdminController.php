<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\updateUserRequest;
use Spatie\Backup\Events\BackupHasFailed;

class AdminController extends Controller
{
    public function index()
    {
        return view('super.partials.dashboard');
    }

    public function userIndex()
    {
        $data['users'] = User::all();

        return view('super.partials.user.index', $data);
    }

    public function create()
    {
        return view('super.partials.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        return User::store($request->validated());
    }

    public function edit(User $user)
    {
        return view('super.partials.user.edit', compact('user'));
    }

    public function update(updateUserRequest $request, User $user)
    {
        return User::updateData($request->validated(), $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    // public function backUp()
    // {
    //     try {
    //         $database = 'bgb_diplomatic';
    //         $username = 'root';
    //         $password = '';
    //         $host = '127.0.0.1';

    //         $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
    //         $filePath = public_path($fileName);

    //         $mysqldump = 'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe';

    //         $command = "\"{$mysqldump}\" -u {$username} -h {$host} {$database} > \"{$filePath}\"";

    //         $output = null;
    //         $result = null;
    //         exec($command, $output, $result);

    //         if ($result !== 0) {
    //             throw new \Exception('mysqldump failed. Please check the credentials or system path.');
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Database backup created successfully.',
    //             'file' => asset($fileName),
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Backup failed: ' . $e->getMessage(),
    //         ]);
    //     }
    // }


    public function backUp()
    {
        Event::forget(BackupHasFailed::class);
        try {
            Artisan::call('backup:run', ['--only-db' => true]);
            return response()->json(['success' => true, 'message' => 'Database backup created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Backup failed: ' . $e->getMessage()]);
        }
    }
}
