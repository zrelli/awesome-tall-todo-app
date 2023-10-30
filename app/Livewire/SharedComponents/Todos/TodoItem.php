<?php
namespace App\Livewire\SharedComponents\Todos;
use App\Jobs\SendEmailsToSubscribers;
use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
class TodoItem extends Component
{
    public Todo $todo;
    public  $userId;
    public $isDetailsPage = false;
    public $isSubscribed;
    public function mount()
    {
        $this->isSubscribed = $this->todo->isSubscribed();
    }
    public function render()
    {
        return view('livewire.shared-components.todos.todo-item');
    }
    public function removeCurrentItem()
    {
        $id = $this->todo->id;
        $this->dispatch('todos:delete', $id);
        $this->dispatch('show-toast', message: 'todo data has been deleted', type: 'success');
    }
    public function editTodoItem()
    {
        $this->dispatch('open-modal', modalType: 'new-todo-modal', title: $this->todo->title, content: $this->todo->content, status: 'update', id: $this->todo->id);
    }
    #[On('update-todo-item')]
    public function updateTodoItem($data)
    {
        if ($this->todo->id && $data['id'] == $this->todo->id) {
            $this->authorize('update', $this->todo);
            unset($data['id']);
            $this->todo->update($data);
            SendEmailsToSubscribers::dispatch($this->todo, 'todo_updated')->onQueue('emails');
            $this->dispatch('show-toast', message: 'data updated', type: 'success');
        }
    }
    public function completeTask()
    {
        $this->authorize('update', $this->todo);
        $this->todo->is_completed = !$this->todo->is_completed;
        $this->todo->save();
        if ($this->todo->is_completed) {
            $this->dispatch('show-toast', message: 'task has been completed', type: 'success');
            SendEmailsToSubscribers::dispatch($this->todo, 'todo_completed')->onQueue('emails');
        } else {
            $this->dispatch('show-toast', message: 'task has been resumed', type: 'success');
        }
    }
    public function subscribeToTodo()
    {
        $this->authorize('subscribe', $this->todo);
        if ($this->isSubscribed) {
            $this->todo->unsubscribe();
            $this->dispatch('show-toast', message: 'You have unsubscribed to a task', type: 'success');
        } else {
            $this->todo->subscribe();
            $this->dispatch('show-toast', message: 'You have subscribed from a task', type: 'success');
        }
        $this->isSubscribed = $this->todo->isSubscribed();
    }
}
