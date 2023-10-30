<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailsToSubscribers;
use App\Mail\NewTaskAddedEmail;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Console\Command;

class SendEmailsToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {


        $todo=Todo::where('id',10)->first();

        https://chat.openai.com/c/bdab742f-adfd-4231-9264-76a3bfefa30f
        // User::chunk(100, function ($users) {
        //     foreach ($users as $user) {
                SendEmailsToSubscribers::dispatch($todo)->onQueue('emails');
           // }
      //  });
    }
}
