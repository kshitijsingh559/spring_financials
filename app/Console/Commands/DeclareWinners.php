<?php

namespace App\Console\Commands;

use App\Services\V1\UserService\UserServiceInterface;
use Illuminate\Console\Command;

class DeclareWinners extends Command
{
    protected $userService;

    public function __construct(UserServiceInterface $userService) {
        parent::__construct();
        $this->userService = $userService;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:declare-winners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will declare winner.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->userService->declareWinner();
    }
}
