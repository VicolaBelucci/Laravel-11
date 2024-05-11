<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TasksFilterCategory extends Component
{
    public $categories; 

    public $tasks; 

    public $selectedCategory = null;

    public function getCategories()
    {
        $this->categories = DB::table('tasks')
                    ->leftJoin('categories', 'tasks.category_id', '=', 'categories.id')
                    ->where('tasks.user_id', auth()->id())
                    ->select(
                            'categories.title',
                            'categories.id'
                            )
                    ->distinct() 
                    ->get();
    }

    public function updatedSelectedCategory()
    {
        $this->dispatch('category-changed', category: $this->selectedCategory);
    }

    public function render()
    {
        $this->getCategories();
        
        return view('livewire.tasks.tasks-filter-category');
    }
}
