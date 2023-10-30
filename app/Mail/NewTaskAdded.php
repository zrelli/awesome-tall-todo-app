<?php

namespace App\Mail;

use App\Models\Task;
use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTaskAdded extends Mailable
{
    use Queueable, SerializesModels;
    public $url = "http://localhost/todos/";
    public $todo ;
    public $task ;

    /**
     * Create a new message instance.
     */
    public function __construct(Todo $todo,Task $task)
    {
        $this->todo = $todo;
        $this->task = $task;
        $this->url = $this->url . $todo->id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Task Added',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.tasks.new-task-added',
            with: ['url' => $this->url,'title'=>$this->todo->title, 'taskContent'=>$this->task->content ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
