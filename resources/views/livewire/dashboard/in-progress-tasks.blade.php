<div class="w-full sm:w-1/3">
    <div class="py-12 flex justify-center">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="relative">
                <div class="bg-white min-h-96 max-h-96 overflow-y-auto dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <h2 class="p-6 pb-0 text-gray-900">Tarefas Em Progresso</h2>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- Conteúdo do card -->
                        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                <tr>
                                    <th class="text-center">Pendente</th>
                                    <th class="text-center">Completa</th>
                                    <th class="text-center">Tarefa</th>   
            
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inProgressTasks as $task)
                                <tr wire:key="task-{{$task->id}}">
                                    <td class="px-4 py-2">
                                        <input type="checkbox" id="other-task-{{$task->id}}" class="me-3" wire:change="changeStatus({{$task->id}}, 'pending')" @if($task->status === 'pending') checked @endif>
                                    </td>
                                    <td class="px-4 py-2">

                                        <input type="checkbox" id="task-{{$task->id}}" class="me-3" wire:change="changeStatus({{$task->id}}, 'completed')" @if($task->status === 'completed') checked @endif>
                                    </td>
                                    <td class="px-4 py-2">
                                        <label for="task-{{$task->id}}">{{$task->title}}</label>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center">Nada aqui, amigão...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">

                </div>
            </div>
        </div>
    </div>
</div>