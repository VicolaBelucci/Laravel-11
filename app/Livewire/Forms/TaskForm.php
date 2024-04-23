<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    #[Validate('required|min:3|max:20')]
    public $title;

    #[Validate('nullable|max:255')]
    public $description; 

    #[Validate('nullable|date')]
    public $expirationDate; 

    #[Validate('required|in:pending,in_progress,completed')]
    public $status; 

    #[Validate('required')]
    public $category;

    public $related_id = null;

    public function store()
    {   
        $this->validate();  

        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'expirationDate' => $this->expirationDate,
            'status' => $this->status,
            'category_id' => $this->category,
            'related_id' => $this->related_id,
        ]);

        return $task;
    }
}
