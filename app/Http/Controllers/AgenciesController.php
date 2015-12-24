<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Transformers\AgencyTransformer;

class AgenciesController extends ApiController
{
    public function index()
    {
        $agencies = Agency::all();

        return $this->respond(
            fractal()->collection($agencies, new AgencyTransformer)->toArray()
        );
    }
}
