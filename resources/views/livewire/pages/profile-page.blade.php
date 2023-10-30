<div>
    <x-slot name="header">
        <x-breadcrumb :breadcrumbs="$breadcrumbs" :$showProfileAvatar></x-breadcrumb>

    </x-slot>
    <div class="py-4 m-auto">
        <div class=" mx-auto bg-white rounded-lg shadow-lg p-6 w-full">
            <div class="text-center">
                <img src="{{ $user->avatar }}" alt="User Avatar" class="w-16 h-16 rounded-full mx-auto mb-4">
                <h1 class="text-2xl font-semibold">{{ $user->name }}</h1>
            </div>
            <div class="mt-4">
                <p class="text-gray-700 underline-offset-4 underline mb-2">Number of Todos: <span class="font-semibold">{{ $totalTodos }}</span></p>
                <p class="text-gray-700 underline-offset-4 underline">Subscribed Count: <span class="font-semibold">{{ $totalSubscriptions }}</span>
                </p>
            </div>
@if (auth()->user()->id == $user->id)
<form wire:submit.prevent="submitForm">
    <h3 class="mt-5 mb-2 text-lg font-medium text-gray-900 dark:text-white">Choose your email provider:</h3>
    <ul class="grid w-full gap-6 md:grid-cols-2">
        @foreach ($emailProviders as $emailProvider)
            <li>
                <input type="radio" id="email-provider-{{ $emailProvider->id }}" name="email-provider"
                    value="{{ $emailProvider->id }}" class="hidden peer" required=""
                    wire:model="selectedProvider">
                <label for="email-provider-{{ $emailProvider->id }}" style="min-height: 200px;"
                    class="email-provider-choice">
                    <svg  class="w-12 h-12  dark:text-white text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                      </svg>
                    <div class="w-full text-lg font-semibold">{{ $emailProvider->name }}</div>
                    <div class="w-full text-sm">{{ $emailProvider->content }}</div>
                </label>
            </li>
        @endforeach
    </ul>
    <div class="mt-5">
        <button type="submit"
            class="bg-primary hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded w-2/3">Submit</button>
    </div>
</form>
@endif





        </div>
    </div>
</div>
