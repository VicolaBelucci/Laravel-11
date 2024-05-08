<div>
    <section class="text-gray-600 body-font">
        <div class="flex justify-between items-baseline">
            <p class="ms-4 mt-4 text-left text-2xl text-black">Todas Tarefas</p>
            
            <!-- Dropdown do Tailwind --> 
            <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left me-4 mt-4">
                <div>
                    <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="x-bind:aria-expanded='open'" aria-haspopup="true">
                        Options
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>  
                    </button>
                </div>
            
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <!-- Menu items -->
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Grafico Donuts</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Gráfico Barras</a>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="container px-5 py-1 mx-auto flex flex-nowrap">
            <div class="lg:w-3/5 md:w-1/2 md:pr-10 md:py-6">

                <div class="mb-8">                       
                    <div class="flex-grow pl-4">
                        <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Tarefas Pendentes</h2>
                        @livewire('dashboard.pending-tasks')
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex-grow pl-4">
                        <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Tarefas Em Progresso</h2>
                        @livewire('dashboard.in-progress-tasks')
                    </div>
                </div>
                        
                <div class="mb-8">  
                    <div class="flex-grow pl-4">
                        <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Tarefas Completas</h2>
                        @livewire('dashboard.completed-tasks')
                    </div>
                </div>
            
            </div>

            <div class="w-full">
                @livewire('dashboard.chart-tasks')
            </div>
        </div>

    </section>
    
</div>