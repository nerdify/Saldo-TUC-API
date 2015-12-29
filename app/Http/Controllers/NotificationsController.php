<?php

namespace App\Http\Controllers;

use App\Notification;
use Jenssegers\Optimus\Optimus;

class NotificationsController extends ApiController
{
    /**
     * Update the specified resource in storage.
     *
     * @param Optimus $optimus
     * @param $number
     * @param $notificationId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Optimus $optimus, $number, $notificationId)
    {
        $notificationId = $optimus->decode($notificationId);

        Notification::findOrFail($notificationId)->update(['received' => 1]);

        return $this->respondNoContent();
    }
}
