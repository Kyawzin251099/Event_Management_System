<?php

namespace App\Http\Controllers;

use App\Contracts\AddressInterface;
use App\Contracts\PlatformUserInterface;
use App\Mail\RegisterMailable;
use App\Contracts\StreetInterface;
use App\Contracts\WardInterface;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\PlatformUserRequest;
use App\Http\Resources\PlatformUserResource;
use App\Models\Address;
use App\Models\Image;
use App\Models\PlatformUser;
use App\Models\Street;
use App\Models\Ward;
use App\Traits\HelperTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class PlatformUserController extends Controller
{
    use ImageTrait, HelperTrait;
    private $genre;
    public function __construct(
        private PlatformUserInterface $platformUserInterface,
        private WardInterface $wardInterface,
        private StreetInterface $streetInterface,
        private AddressInterface $addressInterface
    ) {
        $this->platformUserInterface = $platformUserInterface;
        $this->wardInterface = $wardInterface;
        $this->streetInterface = $streetInterface;
        $this->addressInterface = $addressInterface;
        $this->genre = Config::get('variables.ONE');


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platform_users = $this->platformUserInterface->all();
        return PlatformUserResource::collection($platform_users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->role === Config::get('variables.INDIVIDUAL')) {
            $validatedData['role'] = Config::get('variables.ONE');
        } else if ($request->role === Config::get('variables.CORPORATE')) {
            $validatedData['role'] = Config::get('variables.TWO');
        } else {
            $validatedData['role'] = Config::get('variables.THREE');
        }

        $validatedData['password'] = Hash::make($request->password);

        $find_user = PlatformUser::where('email', $request->email)->first();
        if ($find_user) {
            return response()->json('Email is already exist');
        }
        $user = $this->platformUserInterface->store('PlatformUser', $validatedData);
        // Mail::to($user->email)->send(new RegisterMailable($user));
        $return_data = new PlatformUserResource($user);
        return response()->json([
            'data' => $return_data,
            'message' => 'Successfully Registered',
        ], 200);
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
    public function update(PlatformUserRequest $request, int $id)
    {
        $validated_data = $request->validated();
        $platform_usersArr = [
            'first_name', 'middle_name', 'last_name',
            'gender', 'email', 'phone_no', 'commercial_name'
        ];
        $user = $this->platformUserInterface->findByID('PlatformUser', $id);
        if (!$user) {
            return response()->json([
                'message' => 'User does not exit!'
            ], 401);
        }

        $ward_fields = [];
        $ward_fields['township_id'] = $validated_data['township_id'];
        $ward_fields['ward_name'] = $validated_data['ward_name'];
        $ward = $this->wardInterface->store('Ward', $ward_fields);

        $street_fields = [];
        $street_fields['ward_id'] = $ward->id;
        $street_fields['street_name'] = $validated_data['street_name'];
        $street = $this->streetInterface->store('Street', $street_fields);

        $address_fields = [];
        $address_fields['street_id'] = $street->id;
        $address_fields['platform_user_id'] = auth()->user()->id;
        $address_fields['add_type'] = $validated_data['add_type'];
        $address_fields['block_no'] = $validated_data['block_no'];
        $address_fields['floor'] = $validated_data['floor'];
        $this->addressInterface->store('Address', $address_fields);

        $platform_user = $this->hasChanges($validated_data, $user, $platform_usersArr) ?
            $this->updatePlatformUser($validated_data, $id) : $user;

        $request->hasFile('upload_url') ?
            $this->storeImage($request, auth()->user()->id, $this->genre, $this->platformUserInterface) : false;

        return new PlatformUserResource($platform_user);
    }

    public function destroy(PlatformUser $platform_user)
    {
        // $status = $platform_user->customCascadeUser($platform_user->id) ?
        //     $this->platformUserInterface->delete('PlatformUser', $platform_user->id) : false;
        return $this->platformUserInterface->delete('PlatformUser', $platform_user->id) ?
            response(status: 204) : response()->json([
                'message' => 'Currently, you cannot perform this action!'
            ]);
    }

    public function updatePlatformUser($validated_data, $id)
    {
        $platform_user_fields = [];
        $platform_user_fields['role'] = auth()->user()->role;
        $platform_user_fields['first_name'] = $validated_data['first_name'];
        $platform_user_fields['middle_name'] = $validated_data['middle_name'] ?? null;
        $platform_user_fields['last_name'] = $validated_data['last_name'];
        $platform_user_fields['gender'] = $validated_data['gender'];
        $platform_user_fields['email'] = $validated_data['email'];
        $platform_user_fields['phone_no'] = $validated_data['phone_no'];
        $platform_user_fields['commercial_name'] = $validated_data['commercial_name'] ?? null;
        $platform_user_fields['password'] = Hash::make($validated_data['password']);

        return $this->platformUserInterface->update('PlatformUser', $platform_user_fields, $id);
    }
}
