<?php
namespace App\Livewire\SharedComponents;
use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
class Subscribers extends Component
{
    public $subscribers = [];
    //todo use pagination for subscribers
    public function render()
    {
        return view('livewire.shared-components.subscribers');
    }
  #[On('show-subscribers')]
    public function initData($id){
            $todo = Todo::where('id',$id)->first();
            $this->subscribers = $todo->subscribers;
            if(count($this->subscribers)){
                $this->dispatch('open-modal',modalType:"subscribers-modal");
                return;
            }
            $this->dispatch('show-toast', message: 'No subscribers for this todo', type: 'warning');
    }
}
