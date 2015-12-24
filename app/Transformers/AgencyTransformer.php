<?php

namespace App\Transformers;

use App\Agency;
use League\Fractal\TransformerAbstract;

class AgencyTransformer extends TransformerAbstract
{
    public function transform(Agency $agency)
    {
        return [
            'address' => $agency->address,
            'name' => $agency->name,
            'lat' => doubleval($agency->lat),
            'lng' => doubleval($agency->lng),
        ];
    }
}
