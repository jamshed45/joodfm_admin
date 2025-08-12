<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    protected $fillable = [
        'name', 'slug', 'inventory_service_id', 'is_showed',
    ];

    public function inventoryService()
    {
        return $this->belongsTo(InventoryService::class);
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }

}
