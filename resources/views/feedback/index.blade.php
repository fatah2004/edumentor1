<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feedbacks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($feedback as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-lg font-semibold">{{ __('Feedback ') }}: {{ $item->postTrainingSession->first()->title }}</h2>
                            <p class="text-sm mt-2">User: {{ $item->user->name }}</p>
                            <p class="text-sm">Rating: {{ $item->rating }}</p>
                            <p class="text-sm">Comment: {{ $item->comment }}</p>
                            <div style="display:flex;justify-content:end;">
                                <p class="text-sm">Created: {{ $item->created_at->diffForHumans() }}</p>

                            </div>
                            <!-- You can display more feedback details here -->
                        </div>
                    </div>
                @endforeach
                <div>
                    @if($postTrainingSession)
                    <!-- Display feedback form -->
                    <div class="mt-8">
                        <h2 class="text-lg font-semibold mb-4">{{ $postTrainingSession->title }} Feedback Form</h2>
                        
                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_training_session_id" value="{{ $postTrainingSession->id }}">
                            
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
                                <select id="rating" name="rating" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                
                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
                                <textarea id="comment" name="comment" rows="3" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            </div>
                
                            <button type="submit" style="background-color:rgb(43, 149, 255);"  class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Submit Feedback</button>
                        </form>
                    </div>
                @endif
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
