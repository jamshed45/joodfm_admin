<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_service_id',
        'name',
        'quantity',
        'notes',
        'organization_id',
        'user_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(InventoryService::class);
    }

    public function inventory_service()
    {
        return $this->belongsTo(InventoryService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
