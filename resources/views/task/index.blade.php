<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-3  text-gray-900 dark:text-gray-100">
                    @forelse ($tasks as $task)
                        <div class="border flex flex-col justify-between border-gray-300 dark:border-gray-700 rounded-lg p-4 m-2">
                            <div class="flex items-start justify-between">
                                <h3 class="text-lg font-semibold mb-2">{{ $task->title }}</h3>
                                <span class="status text-sm bg-opacity-70 px-3  rounded-full {{ $task->status == 'pending' ? 'bg-yellow-500' : ($task->status == 'progress' ? 'bg-blue-500' : 'bg-green-500') }}">{{ $task->status }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                            <div class="flex items-end justify-between mt-5">
                                <a href="{{ route('tasks.edit', $task->id) }}" ><x-heroicon-s-pencil-square class="w-6 mx-2" /></a>
                                <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input
                                        class="cursor-pointer px-4 py-2 rounded {{  $task->status == 'pending' ? 'bg-blue-500' : ($task->status == 'progress' ? 'bg-green-500' : '')  }}"
                                        value="{{ $task->status == 'pending' ? 'Start Progress' : ($task->status == 'progress' ? 'Complete' : '') }}"
                                        type="submit"
                                    />
                                </form>
                            </div>
                        </div>

                        @empty
                            <p>No tasks available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
