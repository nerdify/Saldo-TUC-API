<?php

namespace App\Http\Controllers;

use App\Card;
use App\Transformers\CardTransformer;
use Illuminate\Http\Request;

class CardsController extends ApiController
{
    /**
     * Display the specified resource.
     *
     * @param int     $number
     * @param Request $request
     *
     * @return Response
     */
    public function show($number, Request $request)
    {
        $card = Card::where('number', $number)->firstOrFail();

        return $this->respond(
            fractal()
                ->item($card, new CardTransformer())
                ->parseIncludes($request->input('include', []))
                ->toArray()
        );
    }
}
