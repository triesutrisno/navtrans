<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAVTRANS</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div x-data="{ open: false }" class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside 
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 bg-red-700 text-white 
               transform transition duration-200 ease-in-out
               md:relative md:translate-x-0
               flex flex-col">

        <!-- LOGO (STATIC) -->
        <div class="border-b-2 border-white-500 text-center">
            <a href="#" >
                <img src="{{ asset('images/navtrans5.png') }}" class="mx-auto w-32 mb-2">
                <!--<div class="font-bold">NAVTRANS</div>-->
            </a>
        </div>

        <!-- MENU (SCROLLABLE) -->
        <div class="flex-1 overflow-y-auto p-4 space-y-3">

            <!-- MENU -->
            <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded hover:bg-red-600">
                Dashboard
            </a>

            <!-- Ambil Menu Dari Database -->
            @foreach($menus as $menu)
            <div x-data="{ openMenu: false }" class="flex-1 overflow-y-auto">
                <button @click="openMenu = !openMenu" 
                    class="w-full flex justify-between px-3 py-2 hover:bg-red-600 rounded">
                    {{ $menu->menu_nama }}
                    <span x-text="openMenu ? '-' : '+'"></span>
                </button>

                <div x-show="openMenu" class="ml-4 mt-2 border-l-2 border-dashed border-white-400 space-y-1">
                    @foreach($menu->children as $child)
                        <a href="{{ url($child->menu_link) }}" class="block px-3 py-2 rounded 
                            {{ request()->is($child->menu_link)
                                ? 'bg-yellow-500 text-white'
                                : 'text-white hover:bg-red-600'
                            }}
                            ">
                            {{ $child->menu_nama }}
                        </a>
                    @endforeach
                </div>
            </div>

        @endforeach

        </div>        
        <div class="p-4 border-t border-white/30 text-sm flex-shrink-0">
            <div>{{ auth()->user()->name }}</div>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf

                <button 
                    class="px-3 py-1 rounded-md bg-yellow-600 hover:bg-yellow-700 text-white shadow-sm transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- OVERLAY (mobile) -->
    <div x-show="open" @click="open = false"
        class="fixed inset-0 bg-black opacity-50 z-30 md:hidden">
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col w-full">

        <!-- HEADER -->
        <header class="bg-white shadow p-4 flex justify-between items-center">

            <!-- TOGGLE BUTTON -->
            <button @click="open = true" class="md:hidden text-gray-700 text-xl">
                ☰
            </button>
            <div>
            <h1 class="font-semibold">@yield('title')</h1>
            <p class="text-sm text-gray-500 mt-1">
                @yield('subtitle')
            </p>
            </div>    
            <!--        
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-2 py-1 rounded-md bg-red-600 hover:bg-red-700 text-white shadow-sm transition">Logout</button>
            </form>
            -->
        </header>

        <!-- CONTENT -->
        <main class="p-6 overflow-y-auto flex-1">            
            <!-- Halaman Utama -->
            @if(session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700">
                    {{ session('error') }}
                </div>
            @else
                @yield('content')
            @endif
        </main>

    </div>

</div>

<!-- Alpine -->
<script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>