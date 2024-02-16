<?php

namespace App\Http\Controllers;
use App\Models\State;
use App\Http\Requests\StateRequest;
use App\Http\Resources\StateResource;
use App\Contracts\StateInterface;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private StateInterface $stateInterface;
    public function __construct(StateInterface $stateInterface)
    {
        $this->stateInterface = $stateInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $state = $this->stateInterface->all();
        return StateResource::collection($state);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        $validatedData = $request->validated();
        $state = $this->stateInterface->store($validatedData);
        // $state = State::create($validatedData);
        if(!$state){
            return response()->json([
                'message' => 'State not found'
            ], 401);
        }
        return new StateResource($state);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $state = State::find($id);
        if(!$state){
            return response()->json([
                'message' => 'State not found'
            ],401);
        }
        $state = $this->stateInterface->update($validatedData, $id);
        // $state->update($validatedData);
        return new StateResource($state);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::find($id);
        if(!$state){
            return response()->json([
                'message' => 'State not found',
            ], 400);
        }
        $state = $this->stateInterface->delete($id);
        // $state->delete();
        return new StateResource($state);
    }
}
