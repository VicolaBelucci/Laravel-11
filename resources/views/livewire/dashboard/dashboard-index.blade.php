<div>
    <section class="text-gray-600 body-font">
        
        <div class="container px-5 py-1 mx-auto flex flex-wrap gap-4">

            <!-- Card Tarefas Pendentes -->
            <div class="bg-red-200 dark:bg-red-500 rounded-lg overflow-y-auto " style="width: calc(50% - 0.5rem); max-height: 420.792px;">
                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tarefas Pendentes</h4>
                </div>
                <div class="overflow-y-auto">

                    <div class="py-3 flex justify-center ">
                        <div class="w-full mx-auto sm:px-6 lg:px-8">
                            <div class="relative">
                                <div group-id = 1    
                                    x-data="" 
                                    x-init = "Sortablejs.create($el, {
                                    animation: 150,
                                    group: 'tasks',
                                    onSort({to}){
                                        const groupId = to.getAttribute('group-id');
                                        {{-- console.log(groupId); --}}
                                        const tasksIds = Array.from(to.children).map(i =>i.getAttribute('task-id'));
                                        @this.taskManipulation({groupId, tasksIds})
                                    }
                                    })"   
                                >

                            
                                    @foreach($pendingTasks as $task)
                                        
                                        <div class="space-y-1 p-1"
                                            task-id="{{$task->id}}"
                                            wire:key="pendingTask-{{$task->id}}"    
                                        >
                                            <div class="cursor-pointer rounded-lg p-4 bg-white dark:bg-darker shadow-2xl hover:bg-gray-200 flex justify-between items-center"  task-id="{{$task->id}}">
                                                
                                                <!-- Grupo esquerdo com checkboxes e título -->
                                                <div class="flex items-center gap-3"> <!-- gap-3 para espaçamento interno -->
                                                    <div class="flex">
                                                        <input type="checkbox" id="other-task-{{$task->id}}" class="mr-3 flex-none" wire:change="changeStatus({{$task->id}}, 'in_progress')">
                                                        <input type="checkbox" id="task-{{$task->id}}" class="mr-3 flex-none" wire:change="changeStatus({{$task->id}}, 'completed')">
                                                    </div>
                                                    <span class="dark:text-light">{{$task->title}}</span>
                                                </div>
                                            
                                                <!-- Botão no canto direito -->
                                                <button wire:click="" class="text-black">&times;</button>
                                            </div>
                                            
                                        </div>
                                        
                                    
                                    @endforeach
                                </div>

                                <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Bar Chart Tasks -->
            <div class="bg-white rounded-lg overflow-hidden" style="width: calc(50% - 0.5rem);">
                @livewire('dashboard.chart-tasks')
            </div>

            <!-- Card Tarefas Em Progresso -->
            <div class="bg-yellow-200 rounded-lg overflow-y-auto max-h-[378px]" style="width: calc(50% - 0.5rem);">
                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tarefas Em Progresso</h4>
                </div>

                <div class="py-3 flex justify-center">
                    <div class="w-full mx-auto sm:px-6 lg:px-8">
                        <div class="relative">

                            <div group-id = 2    
                                x-data="" 
                                x-init = "Sortablejs.create($el, {
                                animation: 150,
                                group: 'tasks',
                                onSort({to}){
                                    const groupId = to.getAttribute('group-id');
                                    {{-- console.log(groupId); --}}
                                    const tasksIds = Array.from(to.children).map(i =>i.getAttribute('task-id'));
                                    @this.taskManipulation({groupId, tasksIds})
                                }
                                })"  
                            >
                        
                                @foreach($inProgressTasks as $task)
                                    <div class="space-y-1 p-1"
                                        task-id="{{$task->id}}"
                                        wire:key="inProgressTask-{{$task->id}}"                       
                                    >
                                        <div class="cursor-pointer rounded-lg p-4 bg-white hover:bg-gray-50 flex justify-between items-center"  task-id="{{$task->id}}">
                                            
                                            <!-- Grupo esquerdo com checkboxes e título -->
                                            <div class="flex items-center gap-3"> <!-- gap-3 para espaçamento interno -->
                                                <div class="flex">
                                                    <input type="checkbox" id="other-task-{{$task->id}}" class="mr-3 flex-none" wire:change="changeStatus({{$task->id}}, 'pending')">
                                                    <input type="checkbox" id="task-{{$task->id}}" class="mr-3 flex-none" wire:change="changeStatus({{$task->id}}, 'completed')">
                                                </div>
                                                <span>{{$task->title}}</span>
                                            </div>
                                        
                                            <!-- Botão no canto direito -->
                                            <button wire:click="" class="text-black">&times;</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Tarefas Completas -->
            <div class="bg-green-200 rounded-lg overflow-y-auto max-h-[378px]" style="width: calc(50% - 0.5rem);" >
                
                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tarefas Completas</h4>
                </div>

                <div class="py-3 flex justify-center">
                    <div class="w-full mx-auto sm:px-6 lg:px-8">
                        <div class="relative">

                            <div group-id = 3    
                                x-data="" 
                                x-init = "Sortablejs.create($el, {
                                        animation: 150,
                                        group: 'tasks',
                                        onSort({to}){
                                        const groupId = to.getAttribute('group-id');
                                            {{-- console.log(groupId); --}}
                                        const tasksIds = Array.from(to.children).map(i =>i.getAttribute('task-id'));
                                        @this.taskManipulation({groupId, tasksIds})
                                        }
                                    })"
                            >

                            
                                @foreach($completedTasks as $task)
                                    <div class="space-y-1 p-1"
                                        task-id="{{$task->id}}"
                                        wire:key="completedTask-{{$task->id}}"
                                    >
                                        <div class="cursor-pointer rounded-lg p-4 bg-white hover:bg-gray-50 flex justify-between items-center"  task-id="{{$task->id}}">
                                            
                                            <!-- Grupo esquerdo com checkboxes e título -->
                                            <div class="flex items-center gap-3"> <!-- gap-3 para espaçamento interno -->
                                                <div class="flex">
                                                    <input type="checkbox" id="other-task-{{$task->id}}" class="mr-3 flex-none" wire:change="changeStatus({{$task->id}}, 'pending')">
                                                    <input type="checkbox" id="task-{{$task->id}}" class="mr-3 flex-none" wire:change="changeStatus({{$task->id}}, 'in_progress')">
                                                </div>
                                                <span>{{$task->title}}</span>
                                            </div>
                                        
                                            <!-- Botão no canto direito -->
                                            <button wire:click="" class="text-black">&times;</button>
                                        </div>

                                    </div> 
                                @endforeach
                            </div>

                            <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">
                
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>

        </div>
     

    </section>
    
</div>