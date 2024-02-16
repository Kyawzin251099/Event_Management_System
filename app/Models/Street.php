<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Street extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ward_id', 'street_name'];

    public function saveableFields(): array
    {
        return [
            'ward_id' => StringField::new(),
            'street_name' => StringField::new()
        ];
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
