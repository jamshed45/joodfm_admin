<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'note',
        'family_relation_id', // foreign key
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyRelation()
    {
        return $this->belongsTo(FamilyRelation::class, 'family_relation_id');
    }

}
