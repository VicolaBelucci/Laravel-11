<div>
    <div class="py-3 flex justify-center">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="relative">
            
                @forelse($completedTasks as $task)
                    <div wire:key="task-{{$task->id}}" class="flex">
                        <input type="checkbox" id="other-task-{{$task->id}}" class="me-3 flex-none" wire:change="changeStatus({{$task->id}}, 'pending')">
                        <input type="checkbox" id="task-{{$task->id}}" class="me-3 flex-none" wire:change="changeStatus({{$task->id}}, 'in_progress')">
                        <p class="leading-relaxed grow">
                            {{$task->title}}
                        </p>
                    </div>
                    
                @empty
                    <p class="leading-relaxed grow">
                        Nada aqui, amigão...
                    </p>
                @endforelse

                <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">

                </div>
            </div>
        </div>
    </div>
</div>
