<?php

namespace App\Livewire\Tasks;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksFilterDate extends Component
{
    public $months; 

    public $selectedMonth = null;

    public function getMonths()
    {
        $tasksMonths = DB::table('tasks')
                ->selectRaw("DISTINCT EXTRACT(MONTH FROM expirationDate) AS month, EXTRACT(YEAR FROM expirationDate) AS year")
                ->where('user_id', auth()->id())
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

        $monthNames = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];  

        $tasksMonths = $tasksMonths->map(function ($item) use ($monthNames) {
            $formattedMonth = str_pad($item->month, 2, '0', STR_PAD_LEFT); 
            $item->value = "{$formattedMonth}-{$item->year}";
            $item->name = "{$monthNames[$item->month]} {$item->year}";
            return $item;
        });
        
        return $tasksMonths;
    }

    public function updatedSelectedMonth()
    {
        $this->selectedMonth = $this->selectedMonth === '' ? null : $this->selectedMonth;
        $this->dispatch('month-changed', month: $this->selectedMonth);
    }

    #[On('refresh-table-create')]
    #[On('refresh-table-edit')]
    #[On('refresh-table-delete')]
    public function render()
    {
        $this->months = $this->getMonths();

        return view('livewire.tasks.tasks-filter-date');
    }
}
