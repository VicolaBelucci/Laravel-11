<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class PendingTasks extends Component
{   
    public $pendingTasks; 

    public $userId; 

    public $openModal = false; 

    public function mount()
    {
        $this->userId = auth()->id();
        // $this->pendingTasks = $this->getPendingTasks(); 
    }

    public function getPendingTasks()
    {
        $pendingTasks = Task::where('user_id', $this->userId)
            ->where('status', 'pending')
            ->get();
        
        return $pendingTasks;
    }

    public function changeStatus($id, $newStatus)
    {
        // dd('oi');
        $task = Task::find($id);
        if ($task) {
            $task->status = $newStatus;
            $task->save();
            if($newStatus == 'in_progress'){
                $this->dispatch('atualization-tasks')->to(InProgressTasks::class);
            }else{
                $this->dispatch('atualization-tasks')->to(CompletedTasks::class);
            }

            $this->dispatch('atualization-tasks')->to(ChartTasks::class);
        }
    }

    #[On('atualization-tasks')]
    public function render()
    { 
        $this->pendingTasks = $this->getPendingTasks(); // Re-carrega as tasks pendentes
        return view('livewire.dashboard.pending-tasks');
    }
}
