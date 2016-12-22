<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'sakila';

    protected $table = 'category';
}
