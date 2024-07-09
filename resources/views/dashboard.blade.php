<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
<head>

<meta name="csrf-token" content="{{ csrf_token() }}">
</head> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-center gap-6">
                    <a href="{{ route('reminders.index') }}" class="box-menu bg-white text-blue-500 p-6 rounded-lg shadow-lg hover:bg-blue-300 transition duration-300">
                        <i class="fas fa-bell fa-2x mb-2 text-blue-500"></i>
                        <h3 class="text-2xl font-bold">Reminders</h3>
                    </a>
                    <a href="{{ route('events.index') }}" class="box-menu bg-white text-green-500 p-6 rounded-lg shadow-lg hover:bg-green-300 transition duration-300">
                        <i class="fas fa-calendar fa-2x mb-2 text-green-500"></i>
                        <h3 class="text-2xl font-bold">Events</h3>
                    </a>
                    <a href="{{ route('suguan.index') }}" class="box-menu bg-white text-purple-500 p-6 rounded-lg shadow-lg hover:bg-purple-300 transition duration-300">
                        <i class="fas fa-book fa-2x mb-2 text-purple-500"></i>
                        <h3 class="text-2xl font-bold">Suguan</h3>
                    </a>
                    <a href="{{ route('broadcast_suguan.index') }}" class="box-menu bg-white text-red-500 p-6 rounded-lg shadow-lg hover:bg-red-300 transition duration-300">
                        <i class="fas fa-microphone fa-2x mb-2 text-red-500"></i>
                        <h3 class="text-2xl font-bold">Suguan Broadcast</h3>
                    </a>
                    <a href="{{ route('verseoftheweek.index') }}" class="box-menu bg-white text-orange-500 p-6 rounded-lg shadow-lg hover:bg-orange-300 transition duration-300">
                        <i class="fas fa-bible fa-2x mb-2 text-orange-500"></i>
                        <h3 class="text-2xl font-bold">Verse of the week</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .box-menu {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            width: 10vw;
            height: 10vw;
        }
        .box-menu h3 {
            margin-bottom: 0.5rem;
            font-weight: bold; /* Make h3 bold */
            font-size: 1vw;
        }
    </style>
</x-app-layout>