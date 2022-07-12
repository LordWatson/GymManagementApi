<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateRoleRequest;
use App\Http\Resources\V1\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(RoleResource::collection(Role::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raw = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|max:30'
        ]);

        $validated = $raw->validated();

        // Create Role
        $role = Role::create(
            $validated,
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        return response($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return response(RoleResource::make($role), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $raw = Validator::make($request->all(), [
           'name' => 'unique:roles,name|max:30'
        ]);

        $validated = $raw->validated();

        // update returns a bool, 'tap' returns Model - https://medium.com/@taylorotwell/tap-tap-tap-1fc6fc1f93a6
        $updatedRole = tap(Role::find($id))
            ->update($validated);

        return response(RoleResource::make($updatedRole), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if(!$role)
        {
            return response([
                'message' => 'Role does not exist',
            ], 404);
        }

        $role->delete();

        return response([
            'message' => 'Role deleted successfully',
        ], 200);
    }
}
