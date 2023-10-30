<?php
namespace App\Livewire\SharedComponents\Tasks;
use App\Jobs\SendEmailsToSubscribers;
use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use App\Models\Todo;
use Livewire\Component;
class CreateTask extends Component
{
    public TaskForm $form;
    public $id;
    public $todo;
    public function mount(Todo $todo)
    {
        $this->form->setTodo($todo);
    }
    public function render()
    {
        return view('livewire.shared-components.tasks.create-task');
    }
    public function createTaskItem()
    {
        $this->authorize('createTask', $this->todo);
        $this->form->store();
        $task = Task::where('todo_id', $this->todo->id)->latest('created_at')->first();
        SendEmailsToSubscribers::dispatch($this->todo, 'new_task_added', $task)->onQueue('emails');
        $this->dispatch('show-toast', message: 'task has been created', type: 'success');
        $this->dispatch('tasks:reload');
    }
}
