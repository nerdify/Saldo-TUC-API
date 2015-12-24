<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = ['address', 'lat', 'lng', 'name'];
}
