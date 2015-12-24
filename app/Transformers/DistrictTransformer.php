<?php

namespace App\Transformers;

use App\District;
use League\Fractal\TransformerAbstract;

class DistrictTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'neighborhoods',
    ];

    public function transform(District $district)
    {
        return [
            'name' => $district->name,
        ];
    }

    public function includeNeighborhoods(District $district)
    {
        return $this->collection($district->neighborhoods, new NeighborhoodTransformer);
    }
}
