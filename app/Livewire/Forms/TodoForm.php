<?php

namespace App\Livewire\Forms;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Form;

class TodoForm extends Form
{
    #[Rule('required|min:10|max:1000')]
    public $content = '';
    #[Rule('required|min:5|max:100')]
    public $title = '';


    public ?Todo $todo;
    public function setTodo(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function store()
    {
        $userId = auth()->user()->id;
        $this->validate();
        Todo::create([
            'content' => $this->content,
            'user_id' => $userId,
            'title' => $this->title
        ]);
        $this->content = '';
        $this->title = '';
    }
    public function update()
    {
        $this->validate();
        $this->todo->update(
            [
                'content' => $this->content
            ]
        );
    }
}
