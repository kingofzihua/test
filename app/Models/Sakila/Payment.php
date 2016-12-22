<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'sakila';

    protected $table = 'payment';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
