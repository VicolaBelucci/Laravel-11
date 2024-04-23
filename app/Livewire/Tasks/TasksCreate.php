<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use App\Models\Category;
use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TasksCreate extends Component
{
    public $isOpen = false; 

    public $subTarefa = 2; 
    
    public TaskForm $form;

    public function save()
    {
        $createTask = $this->form->store();
        
        if($createTask){
            $this->isOpen = false;
            $this->dispatch('refresh-table-create');
            $this->form->reset();
        }

    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->form->reset();
        $this->reset('subTarefa');
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('user_id', auth()->id())
            ->get();
    }

    #[Computed()]
    public function tasks()
    {
        return Task::where('user_id', auth()->id())
            ->where('category_id', $this->form->category)
            ->get();
    }

    public function render()
    {
        return view('livewire.tasks.tasks-create');
    }
}
