<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $connection = 'sakila';

    protected $table = 'language';
}
