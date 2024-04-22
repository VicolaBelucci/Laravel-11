<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class TasksTable extends Component
{
    public $tasks; 
    public $userId; 

    public function mount()
    {
        $this->userId = auth()->id();
        $this->tasks = Task::where('user_id', $this->userId)->get();
    }

    public function render()
    {
        return view('livewire.tasks.tasks-table');
    }
}
