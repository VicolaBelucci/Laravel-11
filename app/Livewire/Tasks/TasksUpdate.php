<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use App\Models\Category;
use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksUpdate extends Component
{
    public TaskForm $form;

    public $task; 

    public $isOpen = false;

    public $subTarefa = 2; 

    #[On('edit-modal')]
    public function edit($id)
    {
        $task = Task::find($id);

        if(!$task){
            return redirect()->back(); // substituir por sweet alert
        }

        $this->task = $task;
        $this->resetValidation();
        $this->form->title = $task->title;
        $this->form->description = $task->description;
        $this->form->expirationDate = $task->expirationDate;
        $this->form->status = $task->status;
        $this->form->category = $task->category_id;
        $this->subTarefa = $task->related_id ? 1 : 2;
        $this->form->related_id = $task->related_id;
        $this->isOpen = true;

    }

    public function update()
    {
        $this->validate(); 

        $updateTask = $this->task->update([
            'title' => $this->form->title,
            'description' => $this->form->description,
            'expirationDate' => $this->form->expirationDate,
            'status' => $this->form->status,
            'category_id' => $this->form->category,
            'related_id' => $this->form->related_id,
        ]);

        if($updateTask){
            $this->dispatch('refresh-table-edit');
            $this->form->reset();
            $this->reset('task', 'subTarefa');
            $this->isOpen = false;
        }
         
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->form->reset();
        $this->reset('task', 'subTarefa');
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
        return view('livewire.tasks.tasks-update');
    }
}
