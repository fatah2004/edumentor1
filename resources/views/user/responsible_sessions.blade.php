<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Responsible Training Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($sessions->isEmpty())
                        <p>{{ __('No training sessions found.') }}</p>
                    @else
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">{{ __('Title') }}</th>
                                    <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                    <th class="px-4 py-2">{{ __('End Time') }}</th>
                                    <th class="px-4 py-2">{{ __('Action') }}</th> <!-- Add Action column header -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $session)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $session->title }}</td>
                                        <td class="border px-4 py-2">{{ $session->start_time }}</td>
                                        <td class="border px-4 py-2">{{ $session->end_time }}</td>
                                        <td class="border px-4 py-2">
                                            @if($session->hasPostSession)
                                                <p style="color: green">&#10003;</p> <!-- Checkmark emoji -->
                                            @elseif($session->end_time < now())
                                                <p style="color: orange">{{ __('Ongoing') }}</p>
                                            @else
                                                <a href="{{ route('responsible_sessions.submit', $session->id) }}" style="color: rgb(77, 77, 255)" class="btn btn-primary">{{ __('Submit') }}</a>
                                            @endif
                                        </td> <!-- Add action button -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
