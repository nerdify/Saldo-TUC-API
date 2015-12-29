<?php

namespace App\Transformers;

use App\Neighborhood;
use League\Fractal\TransformerAbstract;

class NeighborhoodTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'agencies',
    ];

    public function transform(Neighborhood $neighborhood)
    {
        return [
            'name' => $neighborhood->name,
        ];
    }

    public function includeAgencies(Neighborhood $neighborhood)
    {
        return $this->collection($neighborhood->agencies, new AgencyTransformer());
    }
}
