<?php

namespace App\Http\Controllers;

use App\Contracts\CommonInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CommonRequest;
use App\Models\Common;
use App\Http\Resources\CommonResource;

class CommonController extends Controller
{
    private CommonInterface $commonInterface;
    public function __construct(CommonInterface $commonInterface)
    {
        $this->commonInterface = $commonInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $common = Common::paginate(5);
        return CommonResource::collection($common);
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
    public function store(CommonRequest $request)
    {

        $validatedData = $request->validated();
        $common = $this->commonInterface->store('Common',$validatedData);
        // $common = Common::create($validatedData);
        if (!$common) {
            return response()->json([
                'message' => 'Common not found'
            ], 401);
        }
        return new CommonResource($common);
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
    public function update(CommonRequest $request, int $id)
    {
        $validatedData = $request->validated();
        $common = $this->commonInterface->findByID('Common', $id);
        if (!$common) {
            return response()->json([
                'message' => 'Common id not found'
            ], 401);
        }
        $common = $this->commonInterface->update('Common', $validatedData, $id);
        //$common->update($validatedData);
        return new CommonResource($common);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $common = $this->commonInterface->findByID('Common', $id);
        if (!$common) {
            return response()->json([
                'message' => 'Common not found',
            ], 400);
        }
        $common = $this->commonInterface->delete('Common' ,$id);
        return new CommonResource($common);
    }
}
