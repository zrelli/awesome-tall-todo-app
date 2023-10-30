<?php
namespace App\Livewire\SharedComponents\Tasks;
use App\Jobs\SendEmailsToSubscribers;
use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Livewire\Component;
class TaskItem extends Component
{
    public Task $task;
    public  $taskContent;
    public  $userId;
    public $isSubscribed;
    public $showForm = false;
    public $isOwner;
    public TaskForm $form;
    public function mount(Task $task)
    {
        $this->form->setTask($task);
    }
    public function render()
    {
        return view('livewire.shared-components.tasks.task-item');
    }
    public function deleteTask()
    {
        $id = $this->task->id;
        $this->dispatch('tasks:delete', $id);
        $this->dispatch('show-toast', message: 'Task data has been deleted', type: 'success');
    }
    public function updateTaskItem()
    {
        $this->form->update();
        $todo = $this->task->todo;
        SendEmailsToSubscribers::dispatch($todo,'task_updated',$this->task)->onQueue('emails');
        $this->task->content = $this->form->content;
        $this->dispatch('show-toast', message: 'Task has been updated', type: 'success');
        $this->showForm = false;
    }
    public function completeTask()
    {
        $this->task->is_completed = !$this->task->is_completed;
        $this->task->save();
        $todo = $this->task->todo;
        SendEmailsToSubscribers::dispatch($todo,'task_completed',$this->task)->onQueue('emails');
        if ($this->task->is_completed) {
            $this->dispatch('show-toast', message: 'task has been completed', type: 'success');
        } else {
            $this->dispatch('show-toast', message: 'task has been resumed', type: 'success');
        }
    }
    public function cancelEditing()
    {
        $this->form->content = $this->task->content;
    }
}
