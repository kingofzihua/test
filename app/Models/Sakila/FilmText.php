<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class FilmText extends Model
{
    protected $connection = 'sakila';

    protected $table = 'film_text';
}
