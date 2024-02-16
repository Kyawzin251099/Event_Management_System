<?php

namespace App\Models;

use App\DB\Core\ImageField;
use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['link_id', 'genre', 'upload_url'];

    public function saveableFields(): array
    {
        return [
            'link_id' => StringField::new(),
            'genre' => StringField::new(),
            'upload_url' => ImageField::new(),
        ];
    }
}
