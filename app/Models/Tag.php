<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 标签表
 * Class Tag
 * @package App\Models
 */
class Tag extends Model
{
    use SoftDeletes;
}
