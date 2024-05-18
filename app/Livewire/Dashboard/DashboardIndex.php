<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class DashboardIndex extends Component
{
    public $order;

    public $inProgressTasks; 
    public $pendingTasks;
    public $completedTasks; 

    public $userId; 

    public function mount()
    {
        $this->userId = auth()->id();
        $this->order = auth()->user()->orderCards;
    }

    public function taskManipulation($params)
    {
        // dd($params);
        $grupos = [
            1 => 'pending',
            2 => 'in_progress',
            3 => 'completed'
        ];

        $groupId = $params['groupId'];

        $tasksChildren = Task::findMany($params['tasksIds'])
            ->each(function(Task $task) use ($grupos, $groupId){
                $task->update([
                    'status' => $grupos[$groupId]
                ]);
            }); 
    
        if($tasksChildren){
            $this->dispatch('atualization-tasks')->to(ChartTasks::class);
        }

        $tasksChildren = null;       
        $params = null;
        $groupId = null;

    }

    public function getInProgressTasks()
    {
        $inProgressTasks = Task::where('user_id', $this->userId)
            ->where('status', 'in_progress')
            ->get();
        
        return $inProgressTasks;
    }

    public function getPendingTasks()
    {
        $pendingTasks = Task::where('user_id', $this->userId)
            ->where('status', 'pending')
            ->get();
        
        return $pendingTasks;
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
        $task = Task::find($id);
        if ($task) {
            $task->status = $newStatus;
            $task->save();            
        
            $this->dispatch('atualization-tasks')->to(ChartTasks::class);
        }
    }

    public function render()
    {
        $this->inProgressTasks = $this->getInProgressTasks();
        $this->pendingTasks = $this->getPendingTasks();
        $this->completedTasks = $this->getCompletedTasks();
        return view('livewire.dashboard.dashboard-index');
    }
}
