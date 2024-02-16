<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'name', 'abbrv'];

    public function saveableFields(): array
    {
        return [
            'category' => StringField::new(),
            'name' => StringField::new(),
            'abbrv' => StringField::new()
        ];
    }

    public function venue()
    {
        return $this->hasMany(Venue::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
