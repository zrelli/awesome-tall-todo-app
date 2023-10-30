<?php
namespace App\Livewire\SharedComponents\Todos;
use App\Livewire\Forms\TodoForm;
use Livewire\Attributes\On;
use Livewire\Component;
class CreateTodo extends Component
{
    public TodoForm $form;
    public $id;
    public function render()
    {
        return view('livewire.shared-components.todos.create-todo');
    }
    public function createTodoItem()
    {
        if ($this->id) {
            $this->updateTodoItem();
            return;
        }
        $this->form->store();
        $this->dispatch('close', 'new-todo-modal');
        $this->dispatch('show-toast', message: 'Todo data has been created', type: 'success');
        $this->dispatch('todos:reset-page');
    }
    public function updateTodoItem()
    {
        $validatedData = $this->form->validate();
        $validatedData['id'] = $this->id;
        $this->dispatch('update-todo-item', $validatedData);
        $this->dispatch('close', 'new-todo-modal');
    }
    #[On('close-new-todo-modal')]
    public function close()
    {
        $this->dispatch('reset-form', 'new-todo-modal');
    }
}
