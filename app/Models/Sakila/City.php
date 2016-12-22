<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $connection = 'sakila';

    protected $table = 'city';

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
