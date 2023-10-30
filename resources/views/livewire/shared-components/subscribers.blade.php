<div class="container mx-auto p-4">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Subscribed Users
    </h1>
    <div class="space-y-4 bg-yellow-200 p-4 rounded-lg max-h-[50vh] overflow-y-scroll ">
        @foreach ($subscribers as $subscriber)
            <a href="/profile/{{ $subscriber->id }}">

                <div class="bg-white flex p-2 rounded-lg shadow-md items-center mt-2">
                    <img class="w-12 h-12 rounded-full" src="{{ $subscriber->avatar }}">
                    <p class="text-lg font-semibold ml-4">{{ $subscriber->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
