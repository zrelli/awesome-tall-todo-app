<div class="container mx-auto p-4" x-data="{
    isMine: @json($isOwner)
}">
    <x-slot name="header">
        <x-breadcrumb :breadcrumbs="$breadcrumbs"></x-breadcrumb>
    </x-slot>
    <div class="space-y-2">
        <div class="w-full mt-6" x-data="{
            showCreateForm: @entangle('showCreateForm')
        }">
            <livewire:shared-components.todos.todo-item :$isDetailsPage :$userId :$todo :wire:key="$todo->id" />
            <x-modal name='subscribers-modal'>
                <div class="p-6">
                    <livewire:shared-components.subscribers />
                </div>
            </x-modal>
            <div class="flex items-center space-x-4 mt-4 mb-4" >
                <button x-on:click="showCreateForm = !showCreateForm" x-show="isMine"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
                    x-text="showCreateForm ? 'Cancel' : 'New Task'">
                </button>
                <button wire:click="showSubscribers() "
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    Show Subscribers
                </button>
            </div>
            <div x-show="showCreateForm">
                <livewire:shared-components.tasks.create-task :$todo />
            </div>
        </div>
        <div class="mb-10"></div>
        @if ($tasks->isNotEmpty())
            @foreach ($tasks->items() as $task)
                <livewire:shared-components.tasks.task-item :$task :key="$task->id" :$isOwner />
            @endforeach
            {{ $tasks->links() }}
        @endif
    </div>
</div>
@push('styles')
@endpush
</div>
