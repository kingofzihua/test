<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $connection = 'sakila';

    protected $table = 'store';

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'manager_staff_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function manager()
    {
        return $this->belongsTo(Staff::class, 'manager_staff_id');
    }
}
