<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $connection = 'sakila';

    protected $table = 'inventory';

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
