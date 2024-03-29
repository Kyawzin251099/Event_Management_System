<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    use HasFactory;

    protected $table = 'vw_profileimage';

    public function profile()
    {
        return $this->belongsTo(PlatformUser::class);
    }
}
