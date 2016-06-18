<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neighborhood extends Model
{
    use SoftDeletes;

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
