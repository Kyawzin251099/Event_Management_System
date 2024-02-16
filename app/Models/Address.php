<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['platform_user_id', 'street_id', 'add_type', 'block_no', 'floor'];

    public function saveableFields(): array
    {
        return [
            'platform_user_id' => StringField::new(),
            'street_id' => StringField::new(),
            'add_type' => StringField::new(),
            'block_no' => StringField::new(),
            'floor' => StringField::new(),
        ];
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function platformUser()
    {
        return $this->belongsTo(PlatformUser::class);
    }

    public function venue()
    {
        return $this->hasMany(Venue::class);
    }
}
