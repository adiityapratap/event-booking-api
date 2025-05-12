<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

class Event extends Model
{  
    use HasFactory;
    protected $fillable = ['title', 'description', 'event_date', 'country', 'capacity'];

public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function availableCapacity()
{
    return $this->capacity - $this->bookings()->count();
}
}
