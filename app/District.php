<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

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
