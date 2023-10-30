<div>
    <x-slot name="header">
        <x-breadcrumb :breadcrumbs="$breadcrumbs"></x-breadcrumb>

    </x-slot>
    <div class="py-4 m-auto">
        <x-select-todo-type :$filterType />
        <x-search-todo-form :$searchTitle />
        @if ($todos->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">
                @foreach ($todos->items() as $todo)
                    <livewire:shared-components.todos.todo-item :$userId :todo="$todo" :wire:key="$todo->id" />
                @endforeach
                </template>
            </div>
            {{ $todos->links() }}
        @else
            <div class="text-xl text-primary-dark font-semi-bold"> No data matches your search criteria at the moment.
            </div>
        @endif
    </div>
    <div class="fixed bottom-8 right-8 md:hidden">
        <button class="bg-primary hover:bg-primary text-white rounded-full w-12 h-12 shadow-lg flex items-center justify-center" x-on:click.prevent="$dispatch('open-modal', { modalType: 'new-todo-modal', title: '', content: '', status: 'create' }) ">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
        </button>
      </div>

    @push('scripts')
        <script></script>
    @endpush
    @push('styles')
        <style>
        </style>
    @endpush
</div>
