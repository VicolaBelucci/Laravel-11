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
                <h2 class="text-xl font-bold">{{$dataToModal ? 'Mostrar' : 'Editar'}} Categoria</h2>
                <!-- Botão de Fechar -->
                <button wire:click="closeModal" class="text-black">&times;</button>
            </div>

            <!-- Corpo do Modal -->

            <form wire:submit='update'>
                <!-- Título -->
                <div class="mb-4">
                    <label for="form.title" class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                    <input type="text" id="form.title" wire:model.live="form.title" @if($dataToModal) readonly @endif
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Digite o título da categoria">
                    <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mb-4">
                    <label for="form.description" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
                    <textarea id="form.description" wire:model.live="form.description" rows="3" @if($dataToModal) readonly @endif
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Digite a descrição da categoria"></textarea>
                    <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
                </div>

                
                
                <!-- Categorias Relacionadas -->
                <div class="mb-4 linha-sub-tarefa">
                    
                    <div class="flex-col">
                        <label for="subCategory" class="block text-gray-700 text-sm font-bold mb-2">É sub categoria?</label>
                        <select id="subCategory" wire:model.live="subCategory" class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" @if($dataToModal) disabled @endif>
                            <option value=1>Sim</option>
                            <option value=2>Não</option>
                        </select>
                    </div>
                    

                    @if($subCategory == 1)
                        <!-- Categoria -->
                        <div class="mb-4">
                            <label for="form.category" class="block text-gray-700 text-sm font-bold mb-2">Categoria:</label>
                            <select id="form.category" wire:model.live="form.category" @if($dataToModal) disabled @endif
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option class="">Selecione uma categoria</option>
                                @foreach($this->categories as $category)
                                    <option wire:key='category-{{$category->id}}' value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                                
                            </select>
                            <x-input-error :messages="$errors->get('form.category')" class="mt-2" />
                        </div>
                    @endif
                </div>

                <!-- Botão de Submissão -->
                <div class="flex {{$dataToModal ? 'justify-end' : 'justify-between'}}">
                    <button wire:click="closeModal"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Fechar
                    </button>

                    @if(!$dataToModal)
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Editar Categoria
                        </button>
                    @endif
                </div>
            </form>

        </div>
    </div>
    @endif
</div>
