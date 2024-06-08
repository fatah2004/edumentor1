<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Training Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button onclick="toggleSessions('regular')">Show Regular Sessions</button>
                    <button onclick="toggleSessions('post')">Show Post Sessions</button>

                    <div id="regularSessions">
                        <h3>Regular Sessions</h3>
                        @if($regularSessions->isEmpty())
                            <p>{{ __('No regular sessions found.') }}</p>
                        @else
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{ __('Title') }}</th>
                                        <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                        <th class="px-4 py-2">{{ __('End Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($regularSessions as $session)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $session->title }}</td>
                                            <td class="border px-4 py-2">{{ $session->start_time }}</td>
                                            <td class="border px-4 py-2">{{ $session->end_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <div id="postSessions" style="display: none;">
                        <h3>Post Sessions</h3>
                        @if($postSessions->isEmpty())
                            <p>{{ __('No post sessions found.') }}</p>
                        @else
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{ __('Title') }}</th>
                                        <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                        <th class="px-4 py-2">{{ __('End Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($postSessions as $session)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $session->title }}</td>
                                            <td class="border px-4 py-2">{{ $session->start_time }}</td>
                                            <td class="border px-4 py-2">{{ $session->end_time }}</td>
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
        function toggleSessions(type) {
            if (type === 'regular') {
                document.getElementById('regularSessions').style.display = 'block';
                document.getElementById('postSessions').style.display = 'none';
            } else {
                document.getElementById('regularSessions').style.display = 'none';
                document.getElementById('postSessions').style.display = 'block';
            }
        }
    </script>
</x-app-layout>
