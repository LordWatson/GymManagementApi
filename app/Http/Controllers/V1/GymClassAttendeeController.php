<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\CreateGymClassAttendeeRequest;
use App\Models\GymClass;
use App\Models\GymClassAttendee;
use App\Services\V1\GymClassAttendeeService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GymClassAttendeeController extends Controller
{

    private GymClassAttendeeService $service;

    public function __construct(GymClassAttendeeService $service)
    {
        $this->middleware('is-admin')->only(['index']);
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGymClassAttendeeRequest $gymClassAttendeeRequest)
    {
        $validated = $gymClassAttendeeRequest->validated();

        if(
            $this->service->isUserAlreadyAttendingClass($validated['user_id'], $validated['gym_class_id'])
        ){
            return response([
                'message' => 'User is already attending gym class'
            ], 200);
        }

        if(
            !$this->service->doesGymClassHaveSpace($validated['gym_class_id'])
        ){
            return response([
                'message' => 'Gym class is full'
            ], 200);
        }

        $gymClass = GymClass::find($validated['gym_class_id']);

        $gymClassAttendee = GymClassAttendee::create([
            'gym_class_id' => $validated['gym_class_id'],
            'user_id' => $validated['user_id'],
            'repeated_id' => $gymClass->repeated_id,
        ]);

        return response($gymClassAttendee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GymClassAttendee  $gymClassAttendee
     * @return \Illuminate\Http\Response
     */
    public function show(GymClassAttendee $gymClassAttendee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GymClassAttendee  $gymClassAttendee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GymClassAttendee $gymClassAttendee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GymClassAttendee  $gymClassAttendee
     * @return \Illuminate\Http\Response
     */
    public function destroy(GymClassAttendee $gymClassAttendee)
    {
        //
    }
}
