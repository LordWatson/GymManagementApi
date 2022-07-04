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

        return response($gymClass, 201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GymClass  $gymClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(GymClass $gymClass)
    {
        //
    }
}
