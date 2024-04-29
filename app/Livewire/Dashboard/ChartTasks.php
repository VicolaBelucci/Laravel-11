<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ChartTasks extends Component
{
    public $completedTasks_amount; 

    public $inProgressTasks_amount; 

    public $pendingdTasks_amount;

    public $dataset = []; 

    public function mount()
    {
        $this->loadProperties();
        $this->fillDataset();
    }

    public function fillDataset()
    {
        $labels = ['Pendentes', 'Em Progresso', 'Completas'];


        // $this->dataset['labels'] = $labels; 
        // $this->dataset['values'] = [
        //     $this->pendingdTasks_amount,
        //     $this->inProgressTasks_amount,
        //     $this->completedTasks_amount
        // ];
        $this->dataset = [
            'labels' => ['Pendentes', 'Em Progresso', 'Completas'],
            'datasets' => [
                [
                    'label' => 'Quantidade de Tarefas',
                    'data' => [
                        $this->pendingdTasks_amount,
                        $this->inProgressTasks_amount,
                        $this->completedTasks_amount
                    ],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(187, 247, 208, 0.5)'
                    ]
                ]
            ]
        ];

        // dd($this->dataset);

    }

    public function loadProperties()
    {
        $this->pendingdTasks_amount = $this->pendingTasks();
        $this->inProgressTasks_amount = $this->inProgressTasks();
        $this->completedTasks_amount = $this->completedTasks();
    }

    #[Computed()]
    public function pendingTasks()
    {
        $pendingTasks = Task::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        return $pendingTasks; 
    }

    #[Computed()]
    public function inProgressTasks()
    {
        $inProgressTasks = Task::where('user_id', auth()->id())
            ->where('status', 'in_progress')
            ->count();

        return $inProgressTasks; 
    }

    #[Computed()]
    public function completedTasks()
    {
        $completedTasks = Task::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->count();

        return $completedTasks; 
    }

    public function render()
    {
        return view('livewire.dashboard.chart-tasks');
    }
}
