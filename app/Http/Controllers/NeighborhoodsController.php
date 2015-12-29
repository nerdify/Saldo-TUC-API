<?php

namespace App\Http\Controllers;

use App\Neighborhood;
use App\Transformers\NeighborhoodTransformer;
use Illuminate\Http\Request;

class NeighborhoodsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $neighborhoods = Neighborhood::orderBy('name')->get();

        return $this->respond(
            fractal()
                ->collection($neighborhoods, new NeighborhoodTransformer())
                ->parseIncludes($request->input('include', []))
                ->toArray()
        );
    }
}
