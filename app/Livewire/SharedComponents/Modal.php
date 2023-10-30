<?php
namespace App\Livewire\SharedComponents;
use Livewire\Component;
class Modal extends Component
{
    public $show = false;
    protected $listeners = [
        'show' => 'show'
    ];
    public function show()
    {
        $this->show = true;
    }
    public function render()
    {
        return view('livewire.shared-components.modal');
    }
}
