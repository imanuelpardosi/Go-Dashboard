<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\EmailRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class SendEmail extends Command
{
    protected $email_repository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, EmailRepository $emailRepository)
    {
        parent::__construct();

        $this->email_repository = $emailRepository;
        $this->user_repository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->user_repository->countUserRegisteredToday();

        $this->email_repository->sendDailyReport($user[0]->user_count);
        Log::info('Send email report success');
    }
}
