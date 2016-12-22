<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'sakila';

    protected $table = 'country';

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
