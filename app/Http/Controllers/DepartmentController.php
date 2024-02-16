<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Contracts\DepartmentInterface;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    private DepartmentInterface $departmentInterface;
    public function __construct(DepartmentInterface $departmentInterface)
    {
        $this->departmentInterface = $departmentInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = $this->departmentInterface->all();
        return DepartmentResource::collection($department);
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
    public function store(DepartmentRequest $request)
    {
        $validatedData = $request->validated();
        $department = $this->departmentInterface->store('Department',$validatedData);
        // $department = Department::create($validatedData);
        if(!$department){
            return response()->json([
                'message' => 'Department not found'
            ], 401);
        }
        return new DepartmentResource($department);
        
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
    public function update(DepartmentRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $department = $this->departmentInterface->findByID('Department', $id);
        if(!$department){
            return response()->json([
                'message' => 'Department not found'
            ],401);
        }
        $department = $this->departmentInterface->update('Department' ,$validatedData, $id);
        // $department->update($validatedData);
        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = $this->departmentInterface->findByID('Department', $id);
        if(!$department){
            return response()->json([
                'message' => 'Department not found',
            ], 400);
        }
        $department = $this->departmentInterface->delete('Department',$id);
        // $department->delete();
        return new DepartmentResource($department);
    }
}
