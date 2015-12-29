<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Card;
use App\Transformers\BalanceTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BalancesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int     $cardNumber
     *
     * @return Response
     */
    public function index(Request $request, $cardNumber)
    {
        $fromDate = $request->input('from_date', 10);

        $card = Card::with([
            'balances' => function ($query) use ($fromDate) {
                $query->where('created_at', '>=', Carbon::now()->subDays($fromDate));
            },
        ])->where('number', $cardNumber)->first();

        if (!$card) {
            return $this->respondNotFound();
        }

        return $this->respond(
            fractal()->collection($card->balances, new BalanceTransformer())->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $cardNumber
     *
     * @return Response
     */
    public function store(Request $request, $cardNumber)
    {
        $this->validate($request, ['balance' => 'required|numeric|min:0']);

        $balance = $request->input('balance');
        $card = Card::firstOrCreate(['number' => $cardNumber]);
        $currentBalance = $card->addBalance($balance);

        if ($currentBalance->wasRecentlyCreated) {
            return $this->respondCreated(
                fractal()->item($currentBalance, new BalanceTransformer())->toArray()
            );
        }

        return $this->respond(
            fractal()->item($currentBalance, new BalanceTransformer())->toArray()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return $this->respondUnprocessable();
    }
}
