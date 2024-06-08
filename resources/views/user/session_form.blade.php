<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submit Training Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg">{{ $session->title }}</h3>
                    <p>{{ $session->description }}</p>
                    <p>{{ $session->start_time }} - {{ $session->end_time }}</p>

                    <form method="POST" action="{{ route('responsible_sessions.createPost', $session->id) }}">
                        @csrf
                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">{{ __('Attendee') }}</th>
                                    <th class="px-4 py-2">{{ __('Present') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($session->users as $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">
                                            <input type="checkbox" name="attendees[{{ $user->id }}]" checked>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
