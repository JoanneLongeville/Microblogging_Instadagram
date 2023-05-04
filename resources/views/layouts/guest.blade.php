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
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="w-full relative flex overflow-hidden">

        <!-- Sidebar -->
        <aside class="min-h-screen w-40 flex flex-col relative shadow-md p-6">

            <!-- Logo -->
            <!-- <h1 class="text-xl text-indigo-600">
                <a href="{{ route('posts.index') }}" title="Voir tous les posts" >
                    InstADAgram
                </a>
            </h1> -->
            <a href="{{ route('posts.index') }}" title="Voir tous les posts" class="flex">
                <img src="{{ asset('images/logo_instadagram.png') }}" style="margin-bottom: 20px">
            </a>

            @if(Auth::check())

            <!-- Accueil -->
            <div class="h-10 w-10 py-6 cursor-pointer">
                <a href="{{ route('posts.index') }}" title="Voir tous les posts" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <p class="px-2">Accueil</p>
                </a>
            </div>

            <!-- Recherche -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="px-2">Recherche</p>
            </div>

            <!-- Créer un post -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <a href="{{ route('posts.create') }}" title="Créer un article" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="px-2">Créer</p>
                </a>
            </div>

            <!-- Messages -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
                <p class="px-2">Messages</p>
            </div>

            <!-- Notifications -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <a href="{{ route('posts.notif', Auth::id()) }}" title="Voir mes notifications" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    <p class="px-2">Notifications</p>
                </a>
            </div>


            <!-- Profile -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                @if(Auth::check())
                <a href="{{ route('users.show', Auth::id() ) }}" title="Créer un article" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="px-2">Profil</p>
                </a>
                @else
                <a href="{{ route('login') }}" title="Créer un article" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="px-2">Profil</p>
                </a>
                @endif
            </div>

            <!-- Log out -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <form method="POST" action="{{ route('logout') }}" class="flex">
                    @csrf
                    <a
                        href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        title="Se déconnecter"
                        class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <p class="px-2">Déconnexion</p>
                    </a>
                </form>
            </div>

            @else

            <!-- Accueil -->
            <div class="h-10 w-10 py-6 cursor-pointer">
                <a href="{{ route('posts.index') }}" title="Voir tous les posts" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <p class="px-2">Accueil</p>
                </a>
            </div>

            <!-- Recherche -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="px-2">Recherche</p>
            </div>

            <!-- Register -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <a href="{{ route('register') }}" title="S'inscrire" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    <p class="px-2">S'inscrire</p>
                </a>

            </div>

            <!-- Log in -->
            <div class="h-10 w-10 py-6 cursor-pointer flex">
                <a href="{{ route('login') }}" title="Se connecter" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                    </svg>
                    <p class="px-2">Se connecter</p>
                </a>
            </div>



            @endif

        </aside>

        <!-- Main -->
        <main class="w-full flex flex-col overflow-y-hidden">

            <!-- Header
            <nav class="flex justify-between items-center" style="margin: 10px 0 10px 50px">

                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>
                <div style="border-radius: 50%; background-color: #f9dadb; height: 60px; width: 60px; border: solid 1px #ed4832"></div>

                <div class="flex items-center" style="margin: 0 50px">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pt-0.5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input class="ml-2 outline-none bg-transparent rounded-lg" type="text" name="search" id="search" placeholder="Search..." />
                </div>

            </nav> -->

            <!-- Photos -->
            <div class="flex flex-col items-center">
                {{ $slot }}
            </div>

        </main>

    </div>

</body>

</html>
