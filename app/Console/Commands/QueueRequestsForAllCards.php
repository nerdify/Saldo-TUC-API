<?php

namespace App\Console\Commands;

use App\Card;
use App\Jobs\RequestBalanceForCard;
use Illuminate\Console\Command;
use Laravel\Lumen\Routing\DispatchesJobs;

class QueueRequestsForAllCards extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saldotuc:queueForCards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue the request pull for all cards.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Card::all()->each(function ($card) {
            $this->dispatch(new RequestBalanceForCard($card));
        });
    }
}
