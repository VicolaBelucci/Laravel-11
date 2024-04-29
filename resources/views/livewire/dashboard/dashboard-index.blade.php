<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Visão geral Tarefas
        </h2>
    </x-slot>

    <div>
        @livewire('dashboard.chart-tasks')
    </div>
    
    <div class=" flex flex-col sm:flex-row gap-4">
        @livewire('dashboard.pending-tasks')
        @livewire('dashboard.in-progress-tasks')
        @livewire('dashboard.completed-tasks')
    </div>

    
</div>