<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;
    protected $fillable = ['en_title', 'en_sub_title', 'ar_title', 'ar_sub_title', 'link', 'image' ];
}
