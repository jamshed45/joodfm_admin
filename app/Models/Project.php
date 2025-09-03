<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    'en_name',
    'ar_name',
    'en_location',
    'ar_location',
    'en_scope',
    'ar_scope',
    'en_objective',
    'ar_objective',
    'image',
];

}
