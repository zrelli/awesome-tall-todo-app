<div x-data="{
    isEditing: @entangle('showForm'),
    isOwner: @json($isOwner)}" x-cloak>
    <div class="flex items-center space-x-2 mt-4">
        <div :class="{ 'border-b-4  border-b-green-600': @json($task->is_completed) }" x-show="!isEditing"
            class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            {{ $task->content }}</div>
        <form wire:submit.prevent="updateTaskItem" class=" w-full" x-show="isEditing">
            <div>
                <x-textarea wire:model="form.content" id="taskContent" class="w-full p-2 bg-white border rounded block"
                    type="text" name="taskContent" autocomplete="taskContent" />
                <x-input-error :messages="$errors->get('form.content')" class="mt-2" />
            </div>
            <button class="w-full bg-primary    text-white font-bold py-2 px-4 rounded mt-2 "
                type="submit">save</button>
        </form>
        <div class="hidden md:flex gap-x-2" x-show="isOwner">
            <button wire:click="completeTask()"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Complete</button>
            <button x-on:click="isEditing = !isEditing" wire:click='cancelEditing'
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded edit-button"
                x-text="isEditing ? 'Cancel' : 'Edit'"></button>
            <button wire:click="deleteTask()"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
        </div>
    </div>
    <div class="md:hidden  gap-x-2 flex justify-start w-full mt-2" x-show="isOwner">
        <button wire:click="completeTask()"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Complete</button>
        <button x-on:click="isEditing = !isEditing" wire:click='cancelEditing'
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded edit-button"
            x-text="isEditing ? 'Cancel' : 'Edit'"></button>
        <button wire:click="deleteTask()"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
    </div>
</div>
