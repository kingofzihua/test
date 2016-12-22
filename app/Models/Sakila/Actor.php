<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $connection = 'sakila';

    protected $table = 'actor';
}
