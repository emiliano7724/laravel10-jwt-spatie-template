<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class SpatiePermissionController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return apiwrapper()->ok(Permission::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            \DB::beginTransaction();

            $permiso=Permission::create($request->all());
            $role = Role::where('name', $request->rol)->first();
            $role->givePermissionTo($permiso);

            \DB::commit();
            return apiwrapper()->ok();
        }catch (\Exception $e){

            \DB::rollBack();
            return apiwrapper()->ok($e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $permiso = Permission::findOrFail($id);

        return apiwrapper()->ok($permiso->update($request->all()), "Registro actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
