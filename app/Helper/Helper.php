<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function filter($text)
{
    if($text != ''){
        return Str::title($text);
    }else{
        return 'N/A';
    }
}

function fileName($letterNumber, $filePrefix)
{
    $datePart   = Carbon::now()->format('Y-m-d');
    $letterPart = $letterNumber;
    $prefixPart = Str::slug($filePrefix);

    return [
        'filename' => "{$datePart}_{$letterPart}_{$prefixPart}.pdf",
        'prefix' => $prefixPart,
    ];
}

function uploadFile($file, $filename)
{
    $path = $file->storeAs('public/letter_files', $filename);
    return $path;
}