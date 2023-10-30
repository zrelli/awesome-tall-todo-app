<?php
namespace App\Livewire\Pages;
use App\Jobs\SendEmailTodoDeleted;
use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
class TodosPage extends Component
{
    use WithPagination;
    protected $perPage = 12;
    protected $todos;
    public $filterType = 'all'; // all,me,other
    public $searchTitle = '';
    public $userId;
    public  $breadcrumbs = [
        ['url' => '/todos', 'name' => 'Todos Home']
    ];
    public function mount()
    {
        $this->userId = auth()->user()->id;
    }
    public function render()
    {
        $this->todos = $this->getTodos();
        return view('livewire.pages.todos-page', ['todos' => $this->todos]);
    }
    private function getTodos()
    {
        return Todo::when($this->filterType != 'all', function ($query) {
            if ($this->filterType == 'me') {
                $query->where('user_id', $this->userId);
            } else {
                $query->where('user_id', '!=', $this->userId);
            }
        })->when($this->searchTitle, function ($query) {
            $query->where('title', 'like', '%' . $this->searchTitle . '%');
        })
            ->with([
                'user', 'subscribers'
                =>
                function ($query)  {
                    $query->where('subscriber_id', $this->userId);
                }
            ])
            ->orderBy('created_at', 'desc')->paginate($this->perPage);
    }
    #[On('todos:reset-page')]
    public function getFirstTodosPage()
    {
        $this->resetPage();
    }
    #[On('todos:delete')]
    public function removeTodoItem($id)
    {
        $todo = Todo::where('id', $id)->first();
        $todoId = $todo->id;
        $userId = $todo->user_id;
        $this->authorize('delete', $todo);
        $cacheKey = "owner_" . $userId . "_" . $todoId;
        initSubscribersData($todoId,$cacheKey);
        SendEmailTodoDeleted::dispatch($cacheKey)->onQueue('emails');
        $todo->delete();
    }
    public function changeFilterType($filter)
    {
        $this->filterType = $filter;
        $this->resetPage();
    }
    public function searchByTitle()
    {
        $this->resetPage();
    }
    public function resetSearchForm()
    {
        $this->searchTitle = '';
        $this->resetPage();
    }
}
