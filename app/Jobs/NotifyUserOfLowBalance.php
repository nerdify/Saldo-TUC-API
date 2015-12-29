<?php

namespace App\Jobs;

use App\Balance;
use App\Card;
use App\Notification;
use Carbon\Carbon;
use Parse\ParsePush;

class NotifyUserOfLowBalance extends Job
{
    /**
     * @var Card
     */
    private $card;

    /**
     * @var
     */
    private $balance;

    /**
     * @var int
     */
    private $pushExpirationInterval = Carbon::MINUTES_PER_HOUR * 50;

    /**
     * @param Card $card
     * @param $balance
     */
    public function __construct(Card $card, Balance $balance)
    {
        $this->card = $card;
        $this->balance = $balance;
    }

    /**
     *
     */
    public function handle()
    {
        $notification = new Notification();
        $notification->balance_id = $this->balance->id;

        $this->card->notifications()->save($notification);
        $this->sendNotificationPush($notification, $this->card, $this->balance);
    }

    /**
     * @param $notification
     * @param $card
     * @param $balance
     *
     * @throws \Exception
     */
    private function sendNotificationPush($notification, $card, $balance)
    {
        $channelName = 'card_'.$card->number;
        $optimusId = app('optimus')->encode($notification->id);

        ParsePush::send([
            'channels'            => [$channelName],
            'expiration_interval' => $this->pushExpirationInterval,
            'data'                => [
                'card_balance'    => number_format($balance->balance, 2),
                'card_number'     => $card->number,
                'notification_id' => $optimusId,
            ],
        ]);
    }
}
