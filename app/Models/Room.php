<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        
        'num_room',
        'room_type',
        'ac_non_ac',
        'food',
        'bed_count',
        'rent',
        'phone_number',
        'fileupload',
        'message',
        'id_users'
    ];
}
