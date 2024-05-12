<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Sleep;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;

    public $tasks; 

    public $search; 

    public $userId;
    
    public $categoryForFilter = null;

    public $monthForFilter = null;

    public function mount()
    {
        $this->userId = auth()->id(); 
        // $this->tasks = Task::where('user_id', $this->userId)->get();
    }

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function getStatusTranslation($status)
    {
        $translations = [
            'pending' => 'Pendente',
            'in_progress' => 'Em Progresso',
            'completed' => 'Concluída'
        ];

        return $translations[$status] ?? $status;
    }

    #[On('category-changed')]
    public function categoryFilter($category)
    {
        $this->categoryForFilter = $category;
    }

    #[On('month-changed')]
    public function monthFilter($month)
    {
        $this->monthForFilter = $month;
    }

    #[On('refresh-table-create')]
    #[On('refresh-table-edit')]
    #[On('refresh-table-delete')]
    public function render()
    {   
        $query = DB::table('tasks')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->select('tasks.*', 'categories.title as category_title', 'categories.description as category_description')
            ->where('tasks.user_id', $this->userId);

        if (!is_null($this->categoryForFilter)) {
            $query->where('categories.id', $this->categoryForFilter);
        }

        if (!is_null($this->monthForFilter)) {
            $startOfMonth = Carbon::createFromFormat('m-Y', $this->monthForFilter)->startOfMonth();
            $endOfMonth = Carbon::createFromFormat('m-Y', $this->monthForFilter)->endOfMonth();
            $query->whereBetween('tasks.expirationDate', [$startOfMonth, $endOfMonth]);
        }

        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('tasks.title', 'like', '%' . $this->search . '%')
                      ->orWhere('tasks.description', 'like', '%' . $this->search . '%')
                      ->orWhere('tasks.expirationDate', 'like', '%' . $this->search . '%')
                      ->orWhere('tasks.status', 'like', '%' . $this->search . '%')
                      ->orWhere('categories.title', 'like', '%' . $this->search . '%')
                      ->orWhere('categories.description', 'like', '%' . $this->search . '%');
            });
        }

        $tasks = $query->orderByDesc('created_at')->paginate(10);
        foreach ($tasks as $task) {
            $task->status = $this->getStatusTranslation($task->status);
        }
        Sleep::for(500)->milliseconds();

        return view('livewire.tasks.tasks-table', [
            'tarefas' => $tasks,
        ]);
    }
}
