@props(['userId', 'isDetailsPage'])
<div class="relative mx-auto w-full" x-data="{
    isSubscribed: @entangle('isSubscribed'),
    isMine: @json($userId == $todo->user_id)
}" x-cloak>
    <div class="shadow p-4 rounded-lg bg-white duration-400 ease-in-out transition-transform transform
    {{ $isDetailsPage ? '' : 'hover:scale-110' }}
    "
        :class="{ 'border-b-4  border-b-green-600 ': @json($todo->is_completed) }">
        <a href="{{ route('todos.show', $todo) }}" class="relative inline-block w-full">
            <div class="mb-2">
                <h2 class="font-medium text-base md:text-lg text-gray-800 line-clamp-1" title="New York">
                    {{ $todo?->title }}
                </h2>
            </div>
            <div class="flex justify-center relative rounded-lg overflow-hidden h-auto">
                <div class=" w-full">
                    <div class=" inset-0  bg-yellow-300">
                        <div class="flex flex-col justify-between flex-grow">
                            <p
                                class="leading-relaxed text-base text-black opacity-70 dark:text-gray-300 text-left p-4
                            {{ $isDetailsPage ? '' : 'some-content' }}
                            ">
                                {{ $todo?->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <div class="grid grid-cols-2 mt-2 ">
            <div class="flex items-center">
                <div class="relative">
                    <div class="rounded-full w-6 h-6 md:w-8 md:h-8 bg-gray-200"
                        style="background-image: url('{{ $todo?->user->avatar }}'); background-size: cover;"></div>
                    <span class="absolute top-0 right-0 inline-block w-3 h-3 bg-primary-red rounded-full"></span>
                </div>
                <p class="ml-2 text-gray-800 line-clamp-1">
                    {{ $todo?->user->name }}
                </p>
            </div>
            <div class="flex justify-end">
                <button x-show="isMine" type="button" wire:click='completeTask()' class="todo-item-btn-complete">
                    <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
                <button x-show="isMine" type="button" wire:click='removeCurrentItem()' class="todo-item-btn-delete">
                    <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
                <button type="button" wire:click='subscribeToTodo()' x-show="!isMine" class="todo-item-btn-subscribe">
                    <svg x-show="!isSubscribed" class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                            <path d="M5 3.5L15 11.5" />
                        </g>
                    </svg>
                    <svg x-show="isSubscribed" class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                        </g>
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
                <button type="button" wire:click='editTodoItem()' x-show="isMine" class="todo-item-btn-subscribe">
                    <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                    </svg>
                    <span class="sr-only">Edit Icon</span>
                </button>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .some-content {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 100%;
            }
        </style>
    @endpush
</div>
