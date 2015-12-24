<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = ['name', 'page'];

    /**
     * A district has many neighborhoods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }
}
