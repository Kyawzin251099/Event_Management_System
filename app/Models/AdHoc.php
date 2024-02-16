<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdHoc extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['event_id', 'first_name', 'middle_name', 'last_name', 'phone_no', 'email'];

    public function saveableFields(): array
    {
        return [
            'event_id' => StringField::new(),
            'first_name' => StringField::new(),
            'middle_name' => StringField::new(),
            'last_name' => StringField::new(),
            'phone_no' => StringField::new(),
            'email' => StringField::new(),
        ];
    }

    protected $hidden = [
        'event_id', 'created_at', 'updated_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function qr_ticket()
    {
        return $this->hasMany(QrTicket::class);
    }
}
