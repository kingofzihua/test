<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $connection = 'sakila';

    protected $table = 'rental';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
