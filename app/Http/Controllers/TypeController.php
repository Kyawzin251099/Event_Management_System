<?php

namespace App\Http\Controllers;

use App\Contracts\TypeInterface;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $typeInterface;
    public function __construct(TypeInterface $typeInterface)
    {
        $this->typeInterface = $typeInterface;
    }

    public function index()
    {
        $types = $this->typeInterface->all();
        return TypeResource::collection($types);
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
    public function store(TypeRequest $request)
    {
        $validatedData = $request->validated();
        $type = $this->typeInterface->store($validatedData);
        if(!$type){
            return response()->json([
                'message' => 'Type not found'
            ], 400);
        }
        return new TypeResource($type);
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
    public function update(TypeRequest $request, int $id)
    {
        $validatedData = $request->validated();
        // $type = Type::find($id);
        $type = $this->typeInterface->findById($id);
        if (!$type) {
            return response()->json([
                "message" => "Something wrong and please try again!"
            ], 400);
        }
        $type = $this->typeInterface->update($validatedData,$id);
        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // $type = Type::find($id);
        $type = $this->typeInterface->findById($id);
        if (!$type) {
            return response()->json([
                "message" => "Your type id is not found!"
            ], 400);
        }
        $type = $this->typeInterface->delete($id);
        return new TypeResource($type);
    }
}
