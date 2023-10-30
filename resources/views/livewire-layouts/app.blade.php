<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <x-toast-message></x-toast-message>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
          <!-- Page Heading -->
          @if (isset($header))
          <header class="bg-white dark:bg-gray-800 shadow">
              <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                  {{ $header }}
              </div>
          </header>
      @endif
        <!-- Page Content -->
        <main class="max-w-screen-xl mx-auto p-4 text-center">
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
    <x-modal name='new-todo-modal' focusable>
        <div class="p-6">
            <livewire:shared-components.todos.create-todo />
        </div>
    </x-modal>
</body>
</html>
