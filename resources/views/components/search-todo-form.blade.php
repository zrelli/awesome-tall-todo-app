<div class="mb-4 flex flex-col md:flex-row items-start">
    <form class="flex-1 md:w-1/2 lg:w-1/3 xl:w-1/4 w-full">
        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="search" wire:model="searchTitle" x-on:click.debounce.500ms=" if (!$event.target.value.length) { $wire.resetSearchForm() }" wire:keydown.debounce.300ms="searchByTitle" class="search-title-input" placeholder="Search">
        </div>
    </form>
</div>
