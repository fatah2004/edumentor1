<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('mentors.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4" style="background-color:rgb(43, 149, 255);">{{ __('Create New User') }}</a>
                    </div>
                    <form method="GET" action="{{ route('mentors.index') }}" class="mb-4">
                        <input type="text" name="search" placeholder="{{ __('Search by name') }}" value="{{ request('search') }}" class="form-input mb-4 mt-1 block w-full">
                        <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Search') }}</button>
                    </form>

                    

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Name') }}</th>
                                <th class="px-4 py-2">{{ __('Email') }}</th>
                                <th class="px-4 py-2">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex">
                                            <a href="{{ route('mentors.show', $user->id) }}" style="background-color:rgb(43, 149, 255);" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Show') }}</a>
                                            <a href="{{ route('mentors.edit', $user->id) }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Edit') }}</a>
                                            <form action="{{ route('mentors.destroy', $user->id) }}" method="POST" class="inline-block">
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
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
