<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $connection = 'sakila';

    protected $table = 'address';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($address) {

            return [$address->id => $address->address];

        })->flatten();
    }
}
