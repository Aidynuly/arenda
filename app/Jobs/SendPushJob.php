<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\DTO\NotificationDTO;
use App\Services\FirebaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendPushJob
 * @package App\Jobs
 */
class SendPushJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var NotificationDTO */
    public $notificationDTO;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NotificationDTO $notificationDTO)
    {
        $this->notificationDTO = $notificationDTO;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $pushService = new FirebaseNotification();
        $pushService->send(
            $this->notificationDTO->token,
            $this->notificationDTO->title,
            $this->notificationDTO->body
        );
    }
}
