<x-mail::message>
    <div>
        Todo List : Your Subscribed Todo has been updated
    </div>
    <div>
        Todo Title: {{ $title }}
    </div>
    <div>
        Todo Content: {{ $content }}
    </div>
    <x-mail::button :url="$url" :color="'success'">
        Show Todo Page
    </x-mail::button>
</x-mail::message>
