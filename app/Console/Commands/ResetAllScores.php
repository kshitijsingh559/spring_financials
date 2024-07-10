<?php

namespace App\Console\Commands;

use App\Services\V1\UserService\UserServiceInterface;
use Illuminate\Console\Command;

class ResetAllScores extends Command
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
    protected $signature = 'app:reset-all-scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will reset all scores.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('============= Command Started =============');
        $this->userService->resetAllScores();
        $this->info('============= Command Ended =============');
    }
}
