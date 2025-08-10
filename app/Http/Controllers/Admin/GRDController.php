<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrdRequest;
use App\Models\GRD;

class GRDController extends Controller
{
    public function store(StoreGrdRequest $request)
    {
        return GRD::store($request->validated());
    }
}