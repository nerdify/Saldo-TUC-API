<?php

namespace App\Http\Controllers;

use App\District;
use App\Transformers\DistrictTransformer;
use Illuminate\Http\Request;

class DistrictsController extends ApiController
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
        $districts = District::all();

        return $this->respond(
            fractal()
                ->collection($districts, new DistrictTransformer())
                ->parseIncludes($request->input('include', []))
                ->toArray()
        );
    }
}
