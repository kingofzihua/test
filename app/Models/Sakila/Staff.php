<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $connection = 'sakila';

    protected $table = 'staff';

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
