<?php

namespace App\Http\Controllers;

use App\Contracts\VenueCommentInterface;
use App\Http\Requests\VenueCommentRequest;
use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueCommentResource;
use App\Models\Venue;
use App\Models\VenueComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueCommentController extends Controller
{
    private  $venueCommentInterface;
    public function __construct(VenueCommentInterface $venueCommentInterface)
    {
        $this->venueCommentInterface = $venueCommentInterface;

        $this->authorizeResource(VenueComment::class,'venue_comment');

    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $venueComments = $this->venueCommentInterface->all();
        // $venueComments->load('venue');
        return VenueCommentResource::collection($venueComments);
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
    public function store(VenueCommentRequest $request)
    {
        $validatedData = $request->validated();
        $platformUserId = auth()->user()->id;
        // $validatedData['platform_user_id'] = $platformUserId;
        // $validatedData['venue_id']  = $request->venue_id;
        $dataWithUsercomment = array_merge($validatedData, ['platform_user_id' => $platformUserId, 'venue_id' => $request->venue_id]);
        $venueComment = $this->venueCommentInterface->store('VenueComment',$dataWithUsercomment);
        if (!$venueComment) {
            return response()->json(['message' => 'Can not comment.'], 400);
        }
        return new VenueCommentResource($venueComment); 
        // $validatedData = $request->validated();
        // $venueComment = VenueComment::create([
        //     'venue_id' => $request->venue_id,
        //     'platform_user_id' => auth()->user()->id,
        //     'user_comment' => $validatedData['user_comment']
        // ]);

        // if (!$venueComment) {
        //     return response()->json([
        //         'message' => 'Comment write is not successfully'
        //     ], 400);
        // }

        // return new VenueCommentResource($venueComment);
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
    public function update(VenueCommentRequest $request, VenueComment $venueComment)
    {
        $validated_data = $request->validated();
        $validated_data['platform_user_id'] = Auth::user()->id;
        //$venue_comment->update($validated_data);
        $venue_comment = $this->venueCommentInterface->update('VenueComment', $validated_data, $venueComment->id);
        return new VenueCommentResource($venue_comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VenueComment $venueComment)
    {
        return $this->venueCommentInterface->delete('VenueComment', $venueComment->id) ? response(status:204) : response(status:500);
    }
}
