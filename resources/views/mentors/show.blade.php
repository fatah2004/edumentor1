<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($user->profile_photo)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" style="border-radius:50%;height:150px;" class="rounded-full  mb-2">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                        <p>{{ $user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Sessions Attended') }}</label>
                        <ul>
                            @foreach($attendedSessions as $sessionTitle)
                                <li>{{ $sessionTitle }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Sessions Responsible For') }}</label>
                        <ul>
                            @foreach($responsibleSessions as $sessionTitle)
                                <li>{{ $sessionTitle }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('mentors.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
