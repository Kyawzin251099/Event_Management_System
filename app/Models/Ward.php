<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['township_id', 'ward_name'];

    public function saveableFields(): array
    {
        return [
            'township_id' => StringField::new(),
            'ward_name' => StringField::new()
        ];
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function street()
    {
        return $this->hasMany(Street::class);
    }
}
