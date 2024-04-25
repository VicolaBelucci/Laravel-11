<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryUpdate extends Component
{
    public CategoryForm $form;

    public $category; 

    public $isOpen = false;

    public $dataToModal = false;

    public $subCategory = 2; 

    #[On('edit-modal')]
    public function edit($id)
    {
        $category = Category::find($id);

        if(!$category){
            return redirect()->back(); // substituir por sweet alert
        }

        $this->category = $category;
        $this->resetValidation();
        $this->form->title = $category->title;
        $this->form->description = $category->description;
        $this->subCategory = $category->related_id ? 1 : 2;
        $this->form->related_id = $category->related_id;
        $this->isOpen = true;

    }

    #[On('show-modal')]
    public function showModal($id)
    {
        $category = Category::find($id);
        $this->dataToModal = true; 

        if(!$category){
            return redirect()->back(); // substituir por sweet alert
        }

        $this->category = $category;
        $this->resetValidation();
        $this->form->title = $category->title;
        $this->form->description = $category->description;
        $this->subCategory = $category->related_id ? 1 : 2;
        $this->form->related_id = $category->related_id;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate(); 

        $updateCategory = $this->category->update([
            'title' => $this->form->title,
            'description' => $this->form->description,
            'related_id' => $this->form->related_id,
        ]);

        if($updateCategory){
            $this->dispatch('refresh-table-edit');
            $this->closeModal();
        }
         
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('user_id', auth()->id())
            ->get();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->form->reset();
        $this->resetValidation();
        $this->reset('category', 'subCategory', 'dataToModal');
    }

    public function render()
    {
        return view('livewire.category.category-update');
    }
}
