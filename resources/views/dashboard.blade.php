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
                    <a href="{{ route('reminders.index') }}" class="box-menu bg-white text-blue-500 p-6 rounded-lg shadow-lg hover:bg-blue-100 transition duration-300">
                        <h3 class="text-2xl font-bold mb-2">Reminders</h3>
                        <p class="text-gray-700">View and manage reminders.</p>
                    </a>
                    <a href="{{ route('events.index') }}" class="box-menu bg-white text-green-500 p-6 rounded-lg shadow-lg hover:bg-green-100 transition duration-300">
                        <h3 class="text-2xl font-bold mb-2">Events</h3>
                        <p class="text-gray-700">View and manage events.</p>
                    </a>
                    <a href="{{ route('suguan.index') }}" class="box-menu bg-white text-purple-500 p-6 rounded-lg shadow-lg hover:bg-purple-100 transition duration-300">
                        <h3 class="text-2xl font-bold mb-2">Suguan</h3>
                        <p class="text-gray-700">View and manage suguan.</p>
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
        }
        .box-menu h3 {
            margin-bottom: 0.5rem;
            font-weight: bold; /* Make h3 bold */
        }
        .box-menu p {
            margin: 0;
        }
    </style>
</x-app-layout>
