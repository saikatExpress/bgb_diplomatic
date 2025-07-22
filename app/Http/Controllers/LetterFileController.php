<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Carbon\Carbon;
use App\Models\LetterFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LetterFileController extends Controller
{
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file_type'     => ['required', 'string', 'max:255'],
            'file'          => ['required','file','mimes:pdf','max:10240'],
            'letter_number' => ['required','string','max:255'],
            'file_prefix'   => ['required','string','max:255'],
        ]);

        $letterNumber = ($validated['file_prefix'] == 'reply_file') ? $request->input('reply_no') : $validated['letter_number'];

        // Generate file name and prefix
        $fileInfo = fileName($letterNumber, $validated['file_prefix']);

        $filename = $fileInfo['filename'];
        $prefix = $fileInfo['prefix'];

        $path = uploadFile($request->file('file'),$filename);

        // Build data for DB
        $data = [
            'letter_number' => $validated['letter_number'],
            'file_prefix'   => $prefix,
            'file_name'     => $filename,
            'region'        => $request->input('region', null),
            'sector'        => $request->input('sector', null),
            'battalion'     => $request->input('battalion', null),
            'company'       => $request->input('company', null),
            'bop'           => $request->input('bop', null),
            'file_path'     => Storage::url($path),
        ];

        $data['letter_by'] = $validated['file_type'];

        if($validated['file_prefix'] == 'reply_file') {
            $data['letter_by'] = $validated['file_type'];
            $data['letter_for'] = ($validated['file_type'] == 'BGB') ? 'BSF' : 'BGB';
            $data['reply_no'] = $request->input('reply_no', null);
        }


        $file = LetterFile::create($data);

        if($validated['file_prefix'] == 'reply_file'){
            Letter::where('letter_no', $validated['letter_number'])->update(['status' => 'replied']);
        }

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully.',
            'data'    => $data,
            'last_id' => $file->id
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'last_id'       => 'required|integer|exists:letter_files,id',
            'file_type'     => 'required|string',
            'letter_number' => 'required|string',
        ]);

        $letterNumber = $request->input('letter_number');

        $fileInfo = LetterFile::where('id', $request->input('last_id'))->where('letter_number', $letterNumber)->first();

        if (!$fileInfo) {
            return response()->json([
                'success' => false,
                'message' => 'No matching files found.'
            ]);
        }

        $storagePath = str_replace('/storage/', 'public/', $fileInfo->file_path);

        if (Storage::exists($storagePath)) {
            Storage::delete($storagePath);
        }

        $fileInfo->delete();

        return response()->json([
            'success' => true,
            'message' => 'All files and metadata deleted successfully.'
        ]);
    }
}
