<div>
    <style>
        .linha-sub-tarefa{
            display: flex;
            justify-content: space-between;
        }
    </style>

    @if($isOpen)
    <!-- Fundo escuro semi-transparente -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center p-4">
        <!-- Container do Modal -->
        <div class="bg-white p-6 rounded-lg shadow-lg max-h-full overflow-y-auto" style="min-width: 600px;">
            <!-- Cabeçalho do Modal -->
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-xl font-bold">Criar Tarefa</h2>
                <!-- Botão de Fechar -->
                <button wire:click="$set('isOpen', false)" class="text-black">&times;</button>
            </div>

            <!-- Corpo do Modal -->

            <form wire:submit='update'>
                <!-- Título -->
                <div class="mb-4">
                    <label for="form.title" class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                    <input type="text" id="form.title" wire:model.live="form.title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Digite o título da tarefa">
                    <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mb-4">
                    <label for="form.description" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
                    <textarea id="form.description" wire:model.live="form.description" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Digite a descrição da tarefa"></textarea>
                    <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
                </div>

                <!-- Data de Expiração -->
                <div class="mb-4">
                    <label for="form.expirationDate" class="block text-gray-700 text-sm font-bold mb-2">Data de
                        Expiração:</label>
                    <input type="date" id="form.expirationDate" wire:model.live="form.expirationDate"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <x-input-error :messages="$errors->get('form.expirationDate')" class="mt-2" />
                </div>

                <!-- Status -->
                <fieldset class="mb-4 flex justify-between">
                    <legend class="whitespace-nowrap text-gray-700 text-sm font-bold mb-2">Status:</legend>
                    <div class="flex items-center mb-1">
                        <input type="radio" id="pending" wire:model.live="form.status" value="pending" class="mr-2" checked>
                        <label for="pending">Pendente</label>
                    </div>
                    <div class="flex items-center mb-1">
                        <input type="radio" id="inProgress" wire:model.live="form.status" value="in_progress" class="mr-2">
                        <label for="inProgress">Em Progresso</label>
                    </div>
                    <div class="flex items-center mb-1">
                        <input type="radio" id="completed" wire:model.live="form.status" value="completed" class="mr-2">
                        <label for="completed">Concluído</label>
                    </div>
                    <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
                </fieldset>

                <!-- Categoria -->
                <div class="mb-4">
                    <label for="form.category" class="block text-gray-700 text-sm font-bold mb-2">Categoria:</label>
                    <select id="form.category" wire:model.live="form.category"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option class="">Selecione uma categoria</option>
                        @foreach($this->categories as $category)
                            <option wire:key='category-{{$category->id}}' value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                        
                    </select>
                    <x-input-error :messages="$errors->get('form.category')" class="mt-2" />
                </div>
                
                <!-- Tarefas Relacionadas -->
                <div class="mb-4 linha-sub-tarefa">
                    
                    <div class="flex-col">
                        <label for="subTarefa" class="block text-gray-700 text-sm font-bold mb-2">É sub tarefa?</label>
                        <select id="subTarefa" wire:model.live="subTarefa" class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value=1>Sim</option>
                            <option value=2>Não</option>
                        </select>
                    </div>
                    

                    @if($subTarefa == 1)
                        <div class="flex-col">
                            <label for="relatedTasks" class=" text-gray-700 text-sm font-bold mb-2">Tarefas
                                Relacionadas:</label>
                            <select id="relatedTasks" wire:model.live="form.related_id" class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option >Selecione uma tarefa pai</option>
                                @foreach($this->tasks as $task)
                                    <option wire:key='task-{{$task->id}}' value="{{$task->id}}">{{$task->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <!-- Botão de Submissão -->
                <div class="flex justify-between">
                    <button wire:click="closeModal"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Fechar
                    </button>

                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Editar Tarefa
                    </button>
                </div>
            </form>

        </div>
    </div>
    @endif
</div>
