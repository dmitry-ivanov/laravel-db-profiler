<?php

namespace Illuminated\Database\Tests\App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title'];
}
