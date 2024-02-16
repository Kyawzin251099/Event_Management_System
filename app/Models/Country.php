<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function saveableFields(): array
    {
        return [
            'name' => StringField::new(),
        ];
    }

    public function state()
    {
        return $this->hasMany(State::class);
    }
}
