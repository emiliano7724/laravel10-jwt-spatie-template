<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest;
use App\Models\Rol;

class RolController extends Controller
{
    public function index()
    {
        return Rol::all();
    }

    public function store(RolRequest $request)
    {
        return Rol::create($request->validated());
    }

    public function show(Rol $rol)
    {
        return $rol;
    }

    public function update(RolRequest $request, Rol $rol)
    {
        $rol->update($request->validated());

        return $rol;
    }

    public function destroy(Rol $rol)
    {
        $rol->delete();

        return response()->json();
    }
}
