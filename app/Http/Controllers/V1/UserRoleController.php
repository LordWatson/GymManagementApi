<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateUserRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\V1\UserRoleService;
use Illuminate\Http\Request;

class UserRoleController extends Controller
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
        return response(User::with('roles')->get(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRoleRequest $request)
    {
        $validated = $request->validated();

        if (
            UserRole::where('user_id', $validated['user_id'])->where('role_id', $validated['role_id'])->exists()
        ) {
            return response([
                'message' => 'User already assigned to Role'
            ], 200);
        }

        $created = UserRole::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
        ]);

        return response($created, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response($user, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
