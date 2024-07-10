<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Services\V1\UserService\UserServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateQrCode implements ShouldQueue
{
    protected  $userService;
    /**
     * Create the event listener.
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatedEvent $event): void
    {
        $user = $event->user;
        $this->userService->generateQrCode($user);
    }
}
