<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LTR extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public static function store($data)
    {
        self::create($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'LTR successfully created',
            'data'    => $data
        ]);
    }

    public static function updateData($data, $ltr)
    {
        $ltr->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'LTR successfully updated',
            'data'    => $data
        ]);
    }
}
