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
    @php
        $routeName = Auth::user()->id_role == 1 ? 'admin.profile.index' : 'user.profile.index';
    @endphp
    <a href="{{ route($routeName) }}" class="flex items-center px-6 py-4 space-x-3 border-b border-gray-200">
        <div
            class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A9.003 9.003 0 0112 15a9.003 9.003 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

    </a>
</header>
