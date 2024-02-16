<?php

namespace App\Http\Controllers;

use App\Contracts\PlatformUserInterface;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Config;

class ImageUpdateController extends Controller
{
    use ImageTrait;
    private $genre;

    public function __construct(private PlatformUserInterface $platformUserInterface)
    {
        $this->middleware('auth:sanctum');
        $this->platformUserInterface = $platformUserInterface;
        $this->genre = Config::get('variables.ONE');
    }

    public function update(ImageRequest $request, int $id)
    {
        $image =  $this->updateImage($request, auth()->user()->id, $this->genre, $this->platformUserInterface, $id);
        return new ImageResource($image);
    }
}
