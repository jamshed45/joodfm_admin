<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_service_id', 'recipient_id', 'name', 'note', 'items'];

    public function inventoryService()
    {
        return $this->belongsTo(InventoryService::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }


}
