<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'total_numbers',
        'date',
        'time',
        "arrival_date",
        'depature_date',
        'message',
        'id_users',
        'id_customers',
        'id_rooms',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customers');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'id_rooms');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

}