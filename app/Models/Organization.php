<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User};
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'email',
        'phone',
        'contact_phone',
        'address',
        'lat',
        'long',
        'website',
        'zipcode',
        'url',
        'logo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employees()
    {
        return $this->hasMany(OrganizationEmployee::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function subscriber()
    {
        return $this->hasMany(XenUser::class);
    }

}
