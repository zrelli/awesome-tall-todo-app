@props(["filterType"])
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-4">
    <ul class="flex -mb-px">
        <li class="w-full md:w-1/3 mb-2 md:mb-0" wire:click="changeFilterType('all')" style="cursor: pointer;">
            <a class="{{ $filterType == 'all' ? 'selected-filter-type' : 'unselected-filter-type' }}">All Todos</a>
        </li>
        <li class="w-full md:w-1/3 mb-2 md:mb-0" wire:click="changeFilterType('me')" style="cursor: pointer;">
            <a class="{{ $filterType == 'me' ? 'selected-filter-type' : 'unselected-filter-type' }}">My Todos</a>
        </li>
        <li class="w-full md:w-1/3 mb-2 md:mb-0" wire:click="changeFilterType('other')" style="cursor: pointer;">
            <a class="{{ $filterType == 'other' ? 'selected-filter-type' : 'unselected-filter-type' }}">Other Todos</a>
        </li>
        <li class="hidden md:block w-full self-center text-right">
            <button x-on:click.prevent="$dispatch('open-modal', { modalType: 'new-todo-modal', title: '', content: '', status: 'create' }) "
                class="new-todo-btn">
                New Task
            </button>
        </li>
    </ul>
</div>
