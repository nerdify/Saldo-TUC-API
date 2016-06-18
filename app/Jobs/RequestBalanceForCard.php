<?php

namespace App\Jobs;

use App\Card;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\DispatchesJobs;
use Pheanstalk\Exception;

class RequestBalanceForCard extends Job
{
    use DispatchesJobs;

    /**
     * @var Card
     */
    private $card;

    /**
     * Minimun balance for notifications.
     *
     * @var int
     */
    private $minBalance = 10;

    /**
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Handle Job.
     *
     * @param Client $client
     */
    public function handle(Client $client)
    {
        try {
            $response = $client->get('http://mpeso.saldotuc.com/cards/'.$this->card->number.'/balance');
            $responseParsed = json_decode($response->getBody(), true);

            $this->handleBalance($this->card, $responseParsed['balance']);
        } catch (ClientException $e) {
            if (Response::HTTP_NOT_FOUND == $e->getCode()) {
                $this->card->delete();
            }
        } catch (\Exception $e) {
            Log::info(sprintf(
                'Attempting to queue "request balance" for card %s after exception. Delayed execution for 2 seconds after (%d) attempts. Message: [%s] Exception class: [%s]',
                $this->card->number,
                $this->attempts(),
                $e->getMessage(),
                get_class($e)
            ));
            $this->release(2);
        }
    }

    /**
     * @param $card
     * @param $balance
     */
    private function handleBalance($card, $balance)
    {
        $currentBalance = $card->addBalance($balance);

        if ($this->cardNeedsNotification($card, $balance)) {
            $this->notifyBalance($card, $currentBalance);
        }
    }

    /**
     * @param $card
     * @param $balance
     *
     * @return bool
     */
    private function cardNeedsNotification($card, $balance)
    {
        if ($balance > $this->minBalance) {
            return false;
        }

        $notification = $card->notifications()->latest()->first();

        if (!$notification || $notification->received == 0) {
            return true;
        }

        if (
            $balance != $notification->balance->balance ||
            $notification->updated_at->diffInMinutes(Carbon::now()->addMinutes(5)) >= Carbon::MINUTES_PER_HOUR * 4
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $card
     * @param $balance
     */
    private function notifyBalance($card, $balance)
    {
        $job = (new NotifyUserOfLowBalance($card, $balance))
            ->delay(1)
            ->onQueue('notifications');

        $this->dispatch($job);
    }
}
