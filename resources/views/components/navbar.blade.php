<header class="bg-white shadow px-4 flex justify-between items-center md:px-6 z-20 relative h-[5rem]">
    <div class="flex items-center space-x-2">
        <button @click="toggleSidebar()" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
    </div>
    {{-- <div class="text-sm text-gray-600 hidden md:block">Halo, <span
            class="font-medium">{{ Auth::user()->nama ?? 'Admin' }}</span></div> --}}
    <a href="{{ route('profile.index') }}" class="flex items-center px-6 py-4 space-x-3 border-b border-gray-200">
        <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="h-10 w-auto">
    </a>
</header>
