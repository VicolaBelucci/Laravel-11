<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    #[Validate('required|min:3|max:20')]
    public $title;

    #[Validate('nullable|max:255')]
    public $description; 

    public $related_id = null;

    public function store()
    {   
        $this->validate();  

        $category = Category::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'related_id' => $this->related_id,
        ]);

        return $category;
    }


}
