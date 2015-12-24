<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = ['received'];

    /**
     * A notification belongs to a balance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }
}
