<?php

namespace App\Models\Sakila;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $connection = 'sakila';

    protected $table = 'film';

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function originalLanguage()
    {
        return $this->belongsTo(Language::class, 'original_language_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'film_category');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor');
    }

    public function text()
    {
        return $this->hasOne(FilmText::class);
    }
}
