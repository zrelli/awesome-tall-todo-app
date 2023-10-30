@props(['breadcrumbs', 'showProfileAvatar' => true])
<nav class="text-gray-600 font-light">
    <ol class="list-reset flex text-grey-dark">
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="text-gray-500">
                @if ($loop->last)
                    <span class="text-primary font-semibold">
                        {{ $breadcrumb['name'] }}
                    </span>
                @else
                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                    <span class="mx-2 text-primary font-extrabold">&#x25B8;</span>
                @endif
            </li>
        @endforeach
        @if ($showProfileAvatar)
            <li class="text-gray-500 ml-auto">
                <a href="{{ route('users.profile', auth()->user()->id) }}">
                    <div class="flex items-center">
                        <img src="{{ auth()->user()->avatar }}" alt="User Profile Image"
                            class="w-10 h-10 rounded-full mr-2">
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                </a>
            </li>
        @endif
        <li class="text-gray-500 ml-auto">
            <div class="flex items-end">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            </a>
        </li>
    </ol>
</nav>
