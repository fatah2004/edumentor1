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
                    <div class="flex justify-between mb-4">
                        <div class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" style="background-color:rgb(43, 149, 255);">
                            <a href="{{ route('training_sessions.create') }}" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">{{ __('Create New Training Session') }}</a>
                        </div>
                        <div>
                            <form action="{{ route('training_sessions.index') }}" method="GET">
                                <div class="flex items-center">
                                    <input type="text" name="title" placeholder="Search by Title" class="form-input mr-2" value="{{ request()->input('title') }}">
                                    <input type="date" name="start_date" class="form-input mr-2" value="{{ request()->input('start_date') }}">
                                    <input type="date" name="end_date" class="form-input mr-2" value="{{ request()->input('end_date') }}">
                                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" style="background-color:rgb(43, 149, 255);">{{ __('Filter') }}</button>
                                    <a href="{{ route('training_sessions.index') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Clear Filters') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Title') }}</th>
                                <th class="px-4 py-2">{{ __('Start Time') }}</th>
                                <th class="px-4 py-2">{{ __('End Time') }}</th>
                                <th class="px-4 py-2">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td class="border px-4 py-2">{{ $session->title }}</td>
                                    <td class="border px-4 py-2">{{ $session->start_time }}</td>
                                    <td class="border px-4 py-2">{{ $session->end_time }}</td>
                                    <td class="border px-4 py-2">
                                      <div class="flex">
                                        <a href="{{ route('training_sessions.show', $session->id) }}" style="background-color:rgb(43, 149, 255);" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Show') }}</a>
                                        <a href="{{ route('training_sessions.edit', $session->id) }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Edit') }}</a>
                                        <form action="{{ route('training_sessions.destroy', $session->id) }}" method="POST"  class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color:rgb(244, 73, 73);" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sessions->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
