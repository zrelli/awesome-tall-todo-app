<?php
namespace App\Livewire\Forms;
use App\Models\Task;
use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Form;
class TaskForm extends Form
{
    #[Rule('required|min:10|max:1000')]
    public $content = '';
    public ?Todo $todo;
    public ?Task $task;
    public function setTodo(Todo $todo)
    {
        $this->todo = $todo;
    }
    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->content = $task->content;
    }
    public function store()
    {
        $this->validate();
        $this->todo->tasks()->create([
            'content' => $this->content,
        ]);
        $this->content = '';
    }
    public function update()
    {
        $this->validate();
        $this->task->update(
            [
                'content' => $this->content
            ]
        );
    }
}
