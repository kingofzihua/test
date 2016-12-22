<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'sakila';

    protected $table = 'customer';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
