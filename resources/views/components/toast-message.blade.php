<div>
    @if (session('success'))
        <div x-data="{ visible: true }">
            <div x-show="visible" x-init="setTimeout(() => visible = false, 5000)"
                class="z-50 fixed top-4 right-4 bg-green-500 text-white py-2 px-4 rounded shadow-md">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ visible: true }">
            <div x-show="visible" x-init="setTimeout(() => visible = false, 5000)"
                class="z-50 fixed top-4 right-4 bg-red-500 text-white py-2 px-4 rounded shadow-md">
                {{ session('error') }}
            </div>
        </div>
    @endif
    <div x-data="{ visible: false, message: '',type:'' }"
        x-on:show-toast.window="message=$event.detail.message;type=$event.detail.type;visible = true; setTimeout(() => visible = false, 5000)"
        x-show="visible" class="z-50 fixed top-4 right-4  text-white py-2 px-4 rounded shadow-md"
        x-bind:class="{
            'bg-green-500': type=='success',
            'bg-red-500': type=='error',
            'bg-orange-500': type=='warning',
        }"
        >
        <div x-text="message"></div>
    </div>
</div>
