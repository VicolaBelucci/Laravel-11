<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class InProgressTasks extends Component
{
    public $inProgressTasks; 

    public $userId; 

    public $openModal = false; 

    public function mount()
    {
        $this->userId = auth()->id();
        // $this->inProgressTasks = $this->getInProgressTasks(); 
    }

    public function getInProgressTasks()
    {
        $inProgressTasks = Task::where('user_id', $this->userId)
            ->where('status', 'in_progress')
            ->get();
        
        return $inProgressTasks;
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
                $this->dispatch('atualization-tasks')->to(CompletedTasks::class);
            }

            $this->dispatch('atualization-tasks')->to(ChartTasks::class);
            
        }
    }

    #[On('atualization-tasks')]
    public function render()
    {
        $this->inProgressTasks = $this->getInProgressTasks(); // Re-carrega as tasks pendentes
        return view('livewire.dashboard.in-progress-tasks');
    }
}
