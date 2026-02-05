<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6">
                    <select id="sortByStatus" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded  mt-4">
                        <option value="">All Tasks</option>
                        <option value="pending">Pending</option>
                        <option value="progress">In Progress</option>
                        <option value="done">Completed</option>
                    </select>
                    <a href="{{ route("tasks.create") }}" class="btn-create bg-green-500 rounded py-3 px-4">+ New Task </a>
                </div>
                <div id="taskContainer" class="p-6 grid grid-cols-3 gap-4 text-gray-900 dark:text-gray-100">
                    @forelse ($tasks as $task)
                        <div class="task-item border flex flex-col justify-between border-gray-300 dark:border-gray-700 rounded-lg p-4" data-status="{{ $task->status }}">
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

            <script>
                document.getElementById('sortByStatus').addEventListener('change', function() {
                    const selectedStatus = this.value;
                    const taskItems = document.querySelectorAll('.task-item');
                    const taskContainer = document.getElementById('taskContainer');
                    let visibleCount = 0;

                    taskItems.forEach(task => {
                        if (selectedStatus === '' || task.dataset.status === selectedStatus) {
                            task.style.display = 'flex';
                            visibleCount++;
                        } else {
                            task.style.display = 'none';
                        }
                    });

                    if (visibleCount === 0) {
                        taskContainer.innerHTML = '<p>No tasks available.</p>';
                    }
                });
            </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
