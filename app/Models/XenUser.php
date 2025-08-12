<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class XenUser extends Model
{
    use HasFactory;
    protected $table = 'xen_users';
    protected $fillable = [
        'user_id',
        'organization_id',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'lat',
        'long',
        'dob',
        'phone',
        'state_id',
        'state_id_image_1',
        'state_id_image_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }



}
