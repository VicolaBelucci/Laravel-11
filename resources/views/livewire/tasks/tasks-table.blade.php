<div>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="text-inherit">Titulo</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Data Expiração</th>
                <th>Status</th>
              </tr>
        </thead>

        <tbody>
            @forelse($tasks as $task)
                <tr wire:key='task-{{$task->id}}'>
                    <td class="px-4 pb-2">{{$task->title}}</td>
                    <td class="px-4 pb-2">{{$task->category->title}}</td>
                    <td class="px-4 pb-2">{{$task->description}}</td>
                    <td class="px-4 pb-2 whitespace-nowrap">{{($task->expirationDate)}}</td>
                    <td class="px-4 pb-2">{{$task->status}}</td>
                </tr>
            @empty
                <p>Nada por aqui...</p>
            @endforelse
        </tbody>
    </table>
</div>
