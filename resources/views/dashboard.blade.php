<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="{{ route('reminders.index') }}" class="widget" style="background-color: #100d26; color: white;">
                        <div class="icon">
                            <i class="fas fa-bell fa-2x mb-2 text-white"></i>
                        </div>
                        <div class="info">
                            <h3 class="text-2xl font-bold">Reminders</h3>
                        </div>
                    </a>
                    <a href="{{ route('events.index') }}" class="widget" style="background-color: #1b254c; color: white;">
                        <div class="icon">
                            <i class="fas fa-calendar fa-2x mb-2 text-white"></i>
                        </div>
                        <div class="info">
                            <h3 class="text-2xl font-bold">Events</h3>
                        </div>
                    </a>
                    <a href="{{ route('suguan.index') }}" class="widget" style="background-color: #163851; color: white;">
                        <div class="icon">
                            <i class="fas fa-book fa-2x mb-2 text-white"></i>
                        </div>
                        <div class="info">
                            <h3 class="text-2xl font-bold">Suguan</h3>
                        </div>
                    </a>
                    <a href="{{ route('broadcast_suguan.index') }}" class="widget" style="background-color: #0e537f; color: white;">
                        <div class="icon">
                            <i class="fas fa-microphone fa-2x mb-2 text-white"></i>
                        </div>
                        <div class="info">
                            <h3 class="text-2xl font-bold">Suguan Broadcast</h3>
                        </div>
                    </a>
                    <a href="{{ route('verseoftheweek.index') }}" class="widget" style="background-color: #34808b; color: white;">
                        <div class="icon">
                            <i class="fas fa-book-open fa-2x mb-2 text-white"></i>
                        </div>
                        <div class="info">
                            <h3 class="text-2xl font-bold">Verse of the week</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .widget {
            display: inline-block;
            width: calc(20% - 1rem);
            margin: 0.5rem;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            cursor: pointer;
        }
        .widget:hover {
            transform: scale(1.05);
        }
        .icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .info {
            text-align: center;
        }
        .info h3 {
            margin-bottom: 0.5rem;
            font-weight: bold;
            font-size: 1.2rem;
        }
        @media (max-width: 768px) {
            .widget {
                width: calc(40% - 1rem);
            }
        }
        @media (max-width: 480px) {
            .widget {
                width: calc(60% - 1rem);
            }
        }
    </style>
</x-app-layout>