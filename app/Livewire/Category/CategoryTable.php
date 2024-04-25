<?php

namespace App\Livewire\Category;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Sleep;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTable extends Component
{
    use WithPagination;

    // public $categories; 

    public $search; 

    public $userId; 

    public function mount()
    {
        $this->userId = auth()->id(); 
        // $this->tasks = Task::where('user_id', $this->userId)->get();
    }

    public function updateSearch()
    {
        $this->resetPage();
    }

    
    #[On('refresh-table-create')]
    #[On('refresh-table-edit')]
    #[On('refresh-table-delete')]
    public function render()
    {
        $query = DB::table('categories')
            ->leftjoin('tasks', 'categories.id', '=', 'tasks.category_id')
            ->select('categories.*', DB::raw('GROUP_CONCAT(tasks.title SEPARATOR ", ") as task_titles'))
            ->where('categories.user_id', $this->userId)
            ->groupBy('categories.id')
            ->orderByDesc('categories.created_at');
 

        if (!empty($this->search)) {
            // $query->where(function ($query) {
            //     $query->where('categories.title', 'like', '%' . $this->search . '%')
            //         ->orWhere('categories.description', 'like', '%' . $this->search . '%');                    
            // });

            //---> Método novo
            $query->whereAny([
                'categories.title',
                'categories.description',
            ], 'LIKE', '%'.$this->search.'%');
        }

        $categories = $query->orderByDesc('created_at')->paginate(10);
        Sleep::for(500)->milliseconds();
        
        return view('livewire.category.category-table', [
            'categories' => $categories,
        ]);
    }
}
