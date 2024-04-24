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
                <h2 class="text-xl font-bold">Excluir Tarefa</h2>
                <!-- Botão de Fechar -->
                <button wire:click="closeModal" class="text-black">&times;</button>
            </div>

            <!-- Corpo do Modal -->

            <form wire:submit='delete'>
                <!-- Título -->
                <div class="mb-4 p-3">
                   <p>Tem certeza que deseja excluir a tarefa {{$task->title}}?</p>
                   <p class="ms-4 mt-3"><b>Categoria:</b> {{$task->category->title}}</p>
                   <p class="ms-4 mt-3"><b>Descrição:</b> {{$task->description}}</p>
                   <p class="ms-4 mt-3"><b>Status:</b> {{$task->status}}</p>
                   <p class="ms-4 mt-3"><b>Data de Expiração:</b> {{$task->expirationDate}}</p>
                </div>

                <!-- Botão de Submissão -->
                <div class="flex justify-between">
                    <button wire:click.prevent="closeModal"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Fechar
                    </button>

                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Excluir Tarefa
                    </button>
                </div>
            </form>

        </div>
    </div>
    @endif
</div>
