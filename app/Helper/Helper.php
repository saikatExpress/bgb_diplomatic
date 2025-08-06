<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if(!function_exists('filter')){
    /**
     * Summary of filter
     * @param mixed $text
     * @return string
     */
    function filter($text)
    {
        if($text != ''){
            return Str::title($text);
        }else{
            return 'N/A';
        }
    }
}

if(!function_exists('fileName')){
    /**
     * Summary of fileName
     * @param mixed $letterNumber
     * @param mixed $filePrefix
     * @return array{filename: string, prefix: string}
     */
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
}

if(!function_exists('uploadFile')){
    /**
     * Summary of uploadFile
     * @param mixed $file
     * @param mixed $filename
     */
    function uploadFile($file, $filename)
    {
        $path = $file->storeAs('public/letter_files', $filename);
        return $path;
    }
}

if (!function_exists('formatDate')) {
    /**
     * Format date in multiple styles
     *
     * @param string|\DateTime $date
     * @param string $formatType
     * @return string
     */
    function formatDate($date, $formatType = 'default')
    {
        $date = $date instanceof \DateTime ? $date : new \DateTime($date);

        switch (strtolower($formatType)) {
            case 'date':
                return $date->format('Y-m-d'); // 2025-08-06

            case 'datetime':
                return $date->format('Y-m-d H:i:s'); // 2025-08-06 15:30:45

            case 'time':
                return $date->format('H:i'); // 15:30

            case 'readable':
                return $date->format('F j, Y'); // August 6, 2025

            case 'short':
                return $date->format('d M Y'); // 06 Aug 2025

            case 'long':
                return $date->format('l, F j, Y'); // Wednesday, August 6, 2025

            case 'custom':
                return $date->format('d/m/Y H:i A'); // 06/08/2025 03:30 PM

            case 'relative':
                return Carbon::parse($date)->diffForHumans(); // 2 hours ago

            default:
                return $date->format('Y-m-d');
        }
    }
}
