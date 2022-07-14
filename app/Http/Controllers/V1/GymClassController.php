<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GymClassResource;
use App\Models\GymClass;
use App\Http\Requests\V1\CreateGymClassRequest;
use App\Http\Requests\V1\UpdateGymClassRequest;

class GymClassController extends Controller
{

    public function __construct()
    {
        $this->middleware('is-admin')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(GymClassResource::collection(GymClass::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGymClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGymClassRequest $request)
    {
        $validated = $request->validated();

        // Create Gym Class
        $gymClass = GymClass::create(
            $request->validated(),
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return response(GymClassResource::make($gymClass), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GymClass  $gymClass
     * @return \Illuminate\Http\Response
     */
    public function show(GymClass $gymClass)
    {
        return response(GymClassResource::make($gymClass), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGymClassesRequest  $request
     * @param  \App\Models\GymClass  $gymClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGymClassRequest $request, GymClass $gymClass)
    {
        $validated = $request->validated();

        // update returns a bool, 'tap' returns Model - https://medium.com/@taylorotwell/tap-tap-tap-1fc6fc1f93a6
        $updatedGymClass = tap($gymClass)
            ->update($validated);

        return response(GymClassResource::make($updatedGymClass), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GymClass  $gymClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($gymClass)
    {
        $gymClass = GymClass::find($gymClass);

        if(!$gymClass)
        {
            return response([
                'message' => 'Gym Class does not exist',
            ], 404);
        }

        $gymClass->delete();

        return response([
            'message' => 'Gym Class deleted successfully',
        ], 200);
    }
}
