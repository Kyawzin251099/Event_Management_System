<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable  = ['state_id', 'name'];

    public function saveableFields(): array
    {
        return [
            'state_id' => StringField::new(),
            'name' => StringField::new(),
        ];
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function township()
    {
        return $this->hasMany(Township::class);
    }
}
