<x-mail::message>
    <x-mail::panel>
        <div>
            Todo List: Task has been completed
        </div>
        <div>
            Todo Title: {{ $title }}
        </div>
        <div>
            Task Content: {{ $taskContent }}
        </div>
        <x-mail::button :url="$url" :color="'success'">
            Show Todo Page
        </x-mail::button>
    </x-mail::panel>
</x-mail::message>
