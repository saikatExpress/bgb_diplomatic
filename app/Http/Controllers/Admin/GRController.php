<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrRequest;
use App\Models\GR;

class GRController extends Controller
{
    public function store(StoreGrRequest $request)
    {
        return GR::store($request->validated());
    }
}