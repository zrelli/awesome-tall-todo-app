<form wire:submit.prevent="createTodoItem" class="space-y-6" x-data="{
    modalType: 'new-todo-modal',
    title: @entangle('form.title'),
    content: @entangle('form.content'),
    status: 'create',
    id: @entangle('id'),
    updateText: '{{ __('update task') }}',
    createText: '{{ __('create new task') }}'
}"
    x-on:open-modal.window="
    if ($event.detail.status === 'update') {
        modalType = $event.detail.modalType;
        title = $event.detail.title;
        content = $event.detail.content;
        status = $event.detail.status;
        id = $event.detail.id;
    }
"
    x-on:reset-form.window="
    if ($event.detail) {
        modalType = 'new-todo-modal';
        title = '';
        content = '';
        status = 'create';
        id = '';
    }
">
    <h3 class="text-gray-500  text-center text-lg font-semibold" x-text="status === 'update' ? updateText : createText">
    </h3>
    <div>
        <input type="hidden" wire:model="id" id="id" x-model="id">
    </div>
    <div class="mt-4">
        <x-input-label for="title" :value="__('title')" />
        <x-text-input wire:model="form.title" id="title" class="block mt-1 w-full" name="title" required
            autocomplete="title" />
        <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="content" :value="__('content')" />
        <x-textarea wire:model="form.content" id="content" class="block mt-1 w-full" name="content" required
            autocomplete="title" />
        <x-input-error :messages="$errors->get('form.content')" class="mt-2" />
    </div>
    <div x-data="{ updateText: '{{ __('update task') }}', createText: '{{ __('create new task') }}' }">
        <button type="submit"
        class="submit-btn"
            x-text="status === 'update' ? updateText : createText"></button>
    </div>
</form>
