<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Feedbacks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800">
                    <form action="{{ route('feedback.adminindex') }}" method="GET">
                        <div class="mb-4">
                            <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by User Name:</label>
                            <input type="text" name="user_name" id="user_name" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div class="mb-4">
                            <label for="session_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Session Name:</label>
                            <input type="text" name="session_name" id="session_name" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div class="flex items-center">
                            <button type="submit" style="background-color:rgb(43, 149, 255);" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Apply Filters</button>
                            @if(request()->has('user_name') || request()->has('session_name'))
                                <button type="button" onclick="window.location='{{ route('feedback.adminindex') }}'" style="background-color:rgb(244, 73, 73);" class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:bg-red-600">Remove Filters</button>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800">
                    @if($feedback->isEmpty())
                        <p class="text-gray-700 dark:text-gray-300">No feedback found.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($feedback as $item)
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">User: {{ $item->user->name }}</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">Session: {{ $item->postTrainingSession->title }}</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">Rating: {{ $item->rating }}</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">Comment: {{ $item->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
