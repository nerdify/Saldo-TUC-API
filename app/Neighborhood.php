<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = ['name'];

    /**
     * A neighborhood has many agencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agencies()
    {
        return $this->hasMany(Agency::class);
    }
}
