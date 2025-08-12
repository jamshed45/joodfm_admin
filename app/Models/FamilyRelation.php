<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyRelation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'family_relation_id');
    }
}

