<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Training Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('training_sessions.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-textarea mt-1 block w-full" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Start Time') }}</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('End Time') }}</label>
                            <input type="datetime-local" name="end_time" id="end_time" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="responsible_mentor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Responsible Mentor') }}</label>
                            <select name="responsible_mentor_id" id="responsible_mentor_id" class="form-select mt-1 block w-full">
                                <option value="">{{ __('Select a Mentor') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="attendees" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Attendees') }}</label>
                            <select name="attendees[]" id="attendees" class="form-select mt-1 block w-full" multiple>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if(isset($session) && $session->users->contains($user->id)) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
