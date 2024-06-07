<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('mentors.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" value="current_password" class="form-input mt-1 block w-full">
                            <small class="text-gray-600 dark:text-gray-400">{{ __('Leave as "current_password" to keep current password') }}</small>
                        </div>

                        <div class="mb-4">
                            <label for="profile_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Profile Photo') }}</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-input mt-1 block w-full">
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
