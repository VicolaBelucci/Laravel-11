<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class CompletedTasks extends Component
{
    public $completedTasks; 

    public $userId; 

    public $openModal = false; 

    public function mount()
    {
        $this->userId = auth()->id();
        // $this->completedTasks = $this->getCompletedTasks(); 
    }

    public function getCompletedTasks()
    {
        $completedTasks = Task::where('user_id', $this->userId)
            ->where('status', 'completed')
            ->get();
        
        return $completedTasks;
    }

    public function changeStatus($id, $newStatus)
    {
        // dd('oi');
        $task = Task::find($id);
        if ($task) {
            $task->status = $newStatus;
            $task->save();
            if($newStatus == 'pending'){
                $this->dispatch('atualization-tasks')->to(PendingTasks::class);
            }else{
                $this->dispatch('atualization-tasks')->to(InProgressTasks::class);
            }
            
            $this->dispatch('atualization-tasks')->to(ChartTasks::class);
           
        }
    }

    #[On('atualization-tasks')]
    public function render()
    { 
        $this->completedTasks = $this->getCompletedTasks(); // Re-carrega as tasks 
        return view('livewire.dashboard.completed-tasks');
    }
}
