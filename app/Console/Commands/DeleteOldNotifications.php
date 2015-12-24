<?php

namespace App\Console\Commands;

use App\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saldotuc:notifications:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the old notifications.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deleted = Notification::where('created_at', '<=', Carbon::now()->subDay())->delete();

        Log::info(sprintf(
            'Notifications deleted %d.',
            $deleted
        ));
    }
}
