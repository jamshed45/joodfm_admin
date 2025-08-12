<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryService extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

    // public function attributes()
    // {
    //     return $this->hasMany(Attribute::class);
    // }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_relations', 'inventory_service_id', 'attribute_id');
    }

}
