<x-mail::message>
    <x-mail::panel>
        <div>
            Todo List: Task deleted from subscribed todo
        </div>
        <div>
            Todo Title: {{ $title }}
        </div>
        <x-mail::button :url="$url" :color="'success'">
            Show Todo Page
        </x-mail::button>
    </x-mail::panel>
</x-mail::message>
