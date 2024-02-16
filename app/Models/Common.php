<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'abbrv'];

    public function saveableFields(): array
    {
        return [
            'status' => StringField::new(),
            'abbrv' => StringField::new(),
        ];
    }
}
