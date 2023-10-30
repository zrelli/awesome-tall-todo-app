<?php
namespace App\Livewire\Pages;
use App\Jobs\SendEmailsToSubscribers;
use App\Jobs\SendEmailTodoDeleted;
use App\Models\Task;
use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
class TodoPage extends Component
{
    use WithPagination;
    public  $breadcrumbs = [
        ['url' => '/todos', 'name' => 'Todos Home']
    ];
    public $todo;
    protected $tasks;
    public $userId;
    public $isOwner;
    public $showCreateForm = false;
    public $isDetailsPage = true;
    protected $perPage = 10;
    public function mount(Todo $todo)
    {
        $this->userId = auth()->user()->id;
        $this->isOwner = $this->userId == $todo->user_id;
        $this->tasks = Task::where('todo_id', $todo->id)->paginate($this->perPage);
        $this->breadcrumbs[] = ['url' => '', 'name' => 'Todo Details'];
    }
    public function render()
    {
        $tasks = Task::where('todo_id', $this->todo->id)->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.pages.todo-page', ['tasks' => $tasks]);
    }
    #[On('tasks:delete')]
    public function delete($id)
    {
        $task = Task::find($id);
        $this->authorize('delete', $task);
        $task->delete();
        SendEmailsToSubscribers::dispatch($this->todo, 'task_deleted')->onQueue('emails');
    }
    #[On('todos:delete')]
    public function removeTodoItem($id)
    {
        $todo = Todo::where('id', $id)->first();
        $todoId = $todo->id;
        $userId = $todo->user_id;
        $this->authorize('delete', $todo);
        $cacheKey = "owner_" . $userId . "_" . $todoId;
        //set subscribed users before todo deleted
        initSubscribersData($todoId,$cacheKey);
        SendEmailTodoDeleted::dispatch($cacheKey)->onQueue('emails');
        $todo->delete();
        redirect()->route('todos.index')->with('success', 'todo has been deleted successfully');
    }
    // show subscribers modal
    public function showSubscribers()
    {
        $this->dispatch('show-subscribers', id: $this->todo->id);
    }
    #[On('tasks:reload')]
    public function reloadTasks()
    {
        $this->tasks = Task::where('todo_id', $this->todo->id)->orderBy('created_at', 'desc')->paginate($this->perPage);
        $this->showCreateForm = false;
    }
}
