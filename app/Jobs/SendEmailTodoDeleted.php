<?php
namespace App\Jobs;
use App\Mail\NewTaskAdded;
use App\Mail\TaskDeleted;
use App\Mail\TaskUpdated;
use App\Mail\TodoDeleted;
use App\Mail\TodoUpdated;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class SendEmailTodoDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $cacheKey;
    private $users = [];
    /**
     * Create a new job instance.
     */
    public function __construct($cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->initData();
        foreach ($this->users as $email => $email_provider) {
            Mail::mailer("smtp" . $email_provider)->to($email)->send(new TodoDeleted());
        }
    }
    private function initData()
    {
        $this->users = getSubscribersData($this->cacheKey);
    }
}
