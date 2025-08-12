<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_id',
        'parent_id',
        'key',
        'value',
        'repeat_index',
        'attribute_id',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    // Optional: Parent-child relationship for item grouping
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
