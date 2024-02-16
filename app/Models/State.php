<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'country_id', 'name'
    // ];

    public function saveableFields(): array
    {
        return [
            'country_id' => StringField::new(),
            'name' => StringField::new()
        ];
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }
}
