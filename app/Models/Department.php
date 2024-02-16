<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

   
    public function saveableFields(): array
    {
        return [
            'dept_name' => StringField::new()
        ];
    }

    public function platformUser()
    {
        return $this->hasMany(PlatformUser::class);
    }
}
