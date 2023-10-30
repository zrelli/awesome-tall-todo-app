<?php
namespace App\Jobs;
use App\Mail\NewTaskAdded;
use App\Mail\TaskCompleted;
use App\Mail\TaskDeleted;
use App\Mail\TaskUpdated;
use App\Mail\TodoCompleted;
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
class SendEmailsToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $todo;
    public $task;
    public $mailType;
    private $users = [];
    public $cacheKey;
    /**
     * Create a new job instance.
     */
    public function __construct(Todo $todo, $mailType, Task $task = null, $cacheKey = null)
    {
        //
        $this->todo = $todo;
        $this->task = $task;
        $this->mailType = $mailType;
        $this->cacheKey = $cacheKey;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->initData();
        switch ($this->mailType) {
            case "new_task_added":
                foreach ($this->users as $email => $email_provider) {
                    Mail::mailer("smtp" . $email_provider)->to($email)->send(new NewTaskAdded($this->todo, $this->task));
                }
                break;
            case "task_updated":
                foreach ($this->users as $email => $email_provider) {
                    Mail::mailer("smtp" . $email_provider)->to($email)->send(new TaskUpdated($this->todo, $this->task));
                }
                break;
            case "task_deleted":
                foreach ($this->users as $email => $email_provider) {
                    Mail::mailer("smtp" . $email_provider)->to($email)->send(new TaskDeleted($this->todo));
                }
                break;
            case "todo_updated":
                foreach ($this->users as $email => $email_provider) {
                    Mail::mailer("smtp" . $email_provider)->to($email)->send(new TodoUpdated($this->todo));
                }
                break;
            case "todo_completed":
                foreach ($this->users as $email => $email_provider) {
                    Mail::mailer("smtp" . $email_provider)->to($email)->send(new TodoCompleted($this->todo));
                }
                break;
            case "task_completed":
                foreach ($this->users as $email => $email_provider) {
                    Mail::mailer("smtp" . $email_provider)->to($email)->send(new TaskCompleted($this->todo, $this->task));
                }
                break;
        }
    }
    private function initData()
    {
        if ($this->cacheKey) {
            $this->users = getSubscribersData($this->cacheKey);
        } else {
            $this->users = initSubscribersData($this->todo->id);
        }
    }
}
