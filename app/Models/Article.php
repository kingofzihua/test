<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 文章表
 * Class Article
 * @package App\Models
 */
class Article extends Model
{
    use SoftDeletes;
    function tag()
    {
        return $this->belongsToMany(Tag::class, 'articles_tags');//所要关联的表  中间表  关联模型的外键名称 所要合并的外键名称
    }
}
