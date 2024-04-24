<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksDelete extends Component
{
    public $task; 

    public $isOpen = false;

    public $confirmDelete = false;

    #[On('delete-modal')]
    public function setDelete($id)
    {
        $task = Task::find($id);

        if(!$task){
            return redirect()->back(); // substituir por sweet alert
        }

        $this->task = $task;
        $this->isOpen = true;
        
    }

    public function delete()
    {
        $deleteTask = $this->task->delete(); 
        
        if($deleteTask){
            $this->reset(['task', 'confirmDelete']);
            $this->dispatch('refresh-table-delete');
            $this->isOpen = false;
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['task', 'confirmDelete']);
    }

    public function render()
    {
        return view('livewire.tasks.tasks-delete');
    }
}
