<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Training Session Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                        <p>{{ $session->title }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                        <p>{{ $session->description }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Start Time') }}</label>
                        <p>{{ $session->start_time }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('End Time') }}</label>
                        <p>{{ $session->end_time }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Responsible Mentor') }}</label>
                        <p>{{ $session->responsibleMentor ? $session->responsibleMentor->name : 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Attendees') }}</label>
                        @if($session->users->isEmpty())
                            <p>{{ __('No attendees') }}</p>
                        @else
                            <ul>
                                @foreach($session->users as $user)
                                    <li>{{ $user->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('training_sessions.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
