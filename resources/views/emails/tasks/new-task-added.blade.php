<x-mail::message>
    <x-mail::panel>
        <div>
            Todo List: New task added to subscribed todo
        </div>
        <div>
            Todo Title: {{ $title }}
        </div>
        <div>
            New Task Content: {{ $taskContent }}
        </div>
        <x-mail::button :url="$url" :color="'success'">
            Show Todo Page
        </x-mail::button>
    </x-mail::panel>
</x-mail::message>
