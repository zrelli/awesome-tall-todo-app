<?php

namespace App\Jobs;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteTodo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $todoId;


    /**
     * Create a new job instance.
     */
    public function __construct($todoId)
    {
        $this->todoId = $todoId;
    }
    /**
     * Execute the job.
     */
    public function handle()
    {
        // Retrieve the item by ID and delete it
        $todo = Todo::find($this->todoId);

        if ($todo) {
            $todo->delete();
        }
    }

     // Add a delay method to specify the delay in seconds
     public function delay()
     {
         return now()->addSeconds(10);
     }
}
