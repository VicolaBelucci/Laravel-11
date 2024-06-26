<div>
    <div class="flex justify-between items-center mb-6">
        <p class="text-2xl font-bold">Tarefas</p>
        <div class="flex">
            <input type="text" wire:model.live.debounce.500ms='search' class=" px-3 me-5 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            @livewire('tasks.tasks-create')
        </div>
    </div>

    <div class="relative">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-center">Titulo</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Data Expiração</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ações</th>

                    </tr>
                </thead>
        
                <tbody>
                    @forelse($tarefas as $tarefa)
                        <tr wire:key='task-{{$tarefa->id}}' class="">
                            <td class="px-4 pb-2 text-center">{{$tarefa->title}}</td>
                            <td class="px-4 pb-2 text-center">{{$tarefa->category_title}}</td>
                            <td class="px-4 pb-2 text-center whitespace-nowrap">{{Str::limit($tarefa->description, 50, '...')}}</td>
                            <td class="px-4 pb-2 text-center whitespace-nowrap">{{optional(\Carbon\Carbon::parse($tarefa->expirationDate))->format('d/m/Y') ?? '-'}}</td>
                            <td class="px-4 pb-2 text-center whitespace-nowrap">{{$tarefa->status}}</td>
                            {{-- @dump($tarefa->status) --}}
                            <td class="px-4 pb-2 flex justify-center">
                                
                                <a href="#" wire:click.prevent="$dispatch('show-modal', {id: {{$tarefa->id}} })" class="me-3">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </a> 

                                <a href="#" wire:click.prevent="$dispatch('edit-modal', {id: {{$tarefa->id}} })" class="me-3">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                    </svg>
                                </a>  

                                <a href="" wire:click.prevent="$dispatch('delete-modal', {id: {{$tarefa->id}} })" class="me-3">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>Nada por aqui...</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div wire:loading class="absolute inset-0 bg-white bg-opacity-50">

        </div>
    </div>
    @livewire('tasks.tasks-update')
    @livewire('tasks.tasks-delete')
    <div class="mt-4 flex justify-center">
        {{ $tarefas->links() }}
    </div>
</div>
