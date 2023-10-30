<?php
namespace App\Livewire\Pages;
use App\Models\EmailProvider;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
class ProfilePage extends Component
{
    public $user;
    public $totalTodos = 0;
    public $totalSubscriptions = 0;
    public $selectedProvider;
    public $emailProviders;
    public  $breadcrumbs = [
        ['url' => '/todos', 'name' => 'Todos Home']
    ];
    public $showProfileAvatar = false;
    public function mount(User $user)
    {
        $this->totalTodos = Todo::select(['id', 'user_id'])->where('user_id', $user->id)->count();
        $this->totalSubscriptions = DB::table('todo_subscriptions')->select(['id', 'subscriber_id'])->where('subscriber_id', $user->id)->count();
        $this->emailProviders = EmailProvider::all();
        $this->selectedProvider = $this->user->email_provider_id;
        if ($previous = url()->previous()) {
            $segments = explode('/', $previous);
            $lastSegment = end($segments);
            if ($lastSegment != "todos") {
                $this->breadcrumbs[] = ['url' => $previous, 'name' => 'Details'];
            }
        }
        $this->breadcrumbs[] = ['name' => 'Profile'];
    }
    public function render()
    {
        return view('livewire.pages.profile-page');
    }
    //change user email provider
    public function submitForm()
    {
        $this->authorize('update',auth()->user());
        $this->user->email_provider_id = $this->selectedProvider;
        $this->user->save();
        $this->dispatch('show-toast', message: 'Provider has been changed', type: 'success');
    }
}
