<div class="mb-4 h-6 ">
    <form method="GET" action="{{ url()->current() }}" class="flex items-center space-x-2">
        <input type="text" name="search" placeholder="{{ $placeholder }}" value="{{ request('search') }}"
            class="border border-gray-300 rounded-md px-4 py-2 w-full max-w-md">
        <button type="submit" class="bg-teal-500 text-white px-6 py-2 rounded-md hover:bg-teal-600">
            Cari
        </button>
    </form>
</div>
