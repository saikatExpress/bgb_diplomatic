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
        $backupPath = storage_path('app/public/db');
        $files = [];

        if (File::exists($backupPath)) {
            $files = collect(File::files($backupPath))
                ->filter(fn($file) => $file->getExtension() === 'sql')
                ->sortByDesc(fn($file) => $file->getMTime())
                ->map(fn($file) => [
                    'name' => $file->getFilename(),
                    'url'  => asset('storage/db/' . $file->getFilename()),
                    'size' => round($file->getSize() / 1024, 2) . ' KB',
                    'time' => date('Y-m-d H:i:s', $file->getMTime())
                ])
                ->values()
                ->toArray();
        }
        return view('super.partials.dashboard', compact('files'));
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

    public function backUp()
    {
        try {
            $dbName   = env('DB_DATABASE');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $host     = env('DB_HOST', '127.0.0.1');

            $backupPath = storage_path('app/public/db');
            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0775, true);
            }

            $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
            $fileFullPath = $backupPath . '/' . $fileName;

            $command = "mysqldump -u{$username} -p\"{$password}\" -h {$host} {$dbName} > \"{$fileFullPath}\"";
            exec($command, $output, $result);

            if ($result !== 0) {
                throw new \Exception("mysqldump failed.");
            }

            return response()->json([
                'success' => true,
                'message' => 'Database backup created successfully.',
                'filename' => $fileName,
                'url' => asset("storage/db/{$fileName}"),
                'size' => round(filesize($fileFullPath) / 1024, 2) . ' KB',
                'time' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Backup failed: ' . $e->getMessage(),
            ]);
        }
    }

}
