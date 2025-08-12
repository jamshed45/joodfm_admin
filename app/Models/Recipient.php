<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'first_name',
    'middle_name',
    'last_name',
    'address',
    'lat',
    'long',
    'dob',
    'phone',
    'state_id_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

}
