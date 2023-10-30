<form wire:submit.prevent="createTaskItem" class=" w-full">
    <div class="mt-4">
        <x-textarea wire:model="form.content" id="content"
            class="block mt-1 w-full focus:ring-primary  focus:ring-offset-2 focus:border-none" type="text"
            name="content" autocomplete="content" />
        <x-input-error :messages="$errors->get('form.content')" class="mt-2" />
    </div>
    <button class="w-full bg-green-600    text-white font-bold py-2 px-4 rounded mt-2" type="submit">save</button>
</form>
