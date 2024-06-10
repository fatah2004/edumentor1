<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Training Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Switch button -->
                    <div class="mb-4">
                        <button id="showRegular" style="background-color:rgb(43, 149, 255);" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">{{ __('Show Regular Sessions') }}</button>
                        <button id="showPost" style="background-color:rgb(43, 149, 255);"  class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">{{ __('Show Post Sessions') }}</button>
                    </div>

                    <!-- Regular Sessions -->
                    <div id="regularSessions" class="session-table">
                        @if($regularSessions->isEmpty())
                            <p>{{ __('No regular training sessions found.') }}</p>
                        @else
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{ __('Title') }}</th>
                                        <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                        <th class="px-4 py-2">{{ __('End Time') }}</th>
                                        <th class="px-4 py-2">{{ __('Status') }}</th> <!-- New column for status -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($regularSessions as $session)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $session->title }}</td>
                                            <td class="border px-4 py-2">{{ $session->start_time }}</td>
                                            <td class="border px-4 py-2">{{ $session->end_time }}</td>
                                            <td class="border px-4 py-2">
                                                @if($session->hasPostSession())
                                                <p style="color: red">Absent</p>
                                                @else
                                                    <p style="color: orange">Pending</p>
                                                    
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <!-- Post Sessions -->
                    <div id="postSessions" class="session-table" style="display: none;">
                        @if($postSessions->isEmpty())
                            <p>{{ __('No post training sessions found.') }}</p>
                        @else
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{ __('Title') }}</th>
                                        <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                        <th class="px-4 py-2">{{ __('End Time') }}</th>
                                        <th class="px-4 py-2">{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($postSessions as $session)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $session->postTrainingSessions->first()->title }}</td>
                                            <td class="border px-4 py-2">{{ $session->postTrainingSessions->first()->start_time }}</td>
                                            <td class="border px-4 py-2">{{ $session->postTrainingSessions->first()->end_time }}</td>
                                            <td class="border px-4 py-2">
                                                <p style="color: green">Present</p>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('showRegular').addEventListener('click', function() {
            document.getElementById('regularSessions').style.display = 'block';
            document.getElementById('postSessions').style.display = 'none';
        });

        document.getElementById('showPost').addEventListener('click', function() {
            document.getElementById('regularSessions').style.display = 'none';
            document.getElementById('postSessions').style.display = 'block';
        });
    </script>
</x-app-layout>
