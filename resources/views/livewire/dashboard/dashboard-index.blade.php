<div>
    <section class="text-gray-600 body-font">
        
        <div class="container px-5 py-1 mx-auto flex-col">
            <div class="grid grid-cols-2 gap-4"> <!-- Cria duas colunas de igual tamanho -->
                <div class="bg-red-200 rounded-lg overflow-y-auto max-h-[378px]"> <!-- Grid item com overflow hidden -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tarefas Pendentes</h4>
                    </div>
                    <div class="overflow-y-auto "> <!-- Fixa a altura e adiciona scroll -->
                        @livewire('dashboard.pending-tasks')
                    </div>
                </div>
                
                <div class="bg-white rounded-lg overflow-hidden"> <!-- Segundo grid item com altura fixa e overflow hidden -->
                    @livewire('dashboard.chart-tasks')
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-yellow-200 rounded-lg overflow-y-auto max-h-[378px]">
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tarefas Em Progresso</h4>
                    </div>
                    @livewire('dashboard.in-progress-tasks')
                </div>
        
                <div class="bg-green-200 rounded-lg overflow-y-auto max-h-[378px]">
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tarefas Completas</h4>
                    </div>
                    @livewire('dashboard.completed-tasks')
                </div>
            </div>
        </div>

    </section>
    
</div>