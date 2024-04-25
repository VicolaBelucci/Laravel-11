<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryDelete extends Component
{
    public $category; 

    public $isOpen = false;

    public $confirmDelete = false;

    #[On('delete-modal')]
    public function setDelete($id)
    {
        $category = Category::find($id);

        if(!$category){
            return redirect()->back(); // substituir por sweet alert
        }

        $this->category = $category;
        $this->isOpen = true;
        
    }

    public function delete()
    {
        $deleteCategory = $this->category->delete(); 
        
        if($deleteCategory){
            $this->reset(['category', 'confirmDelete']);
            $this->dispatch('refresh-table-delete');
            $this->isOpen = false;
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['category', 'confirmDelete']);
    }

    public function render()
    {
        return view('livewire.category.category-delete');
    }
}
