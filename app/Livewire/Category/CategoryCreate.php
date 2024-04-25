<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $isOpen = false;

    public $subCategory = 2; 
    
    public CategoryForm $form;

    public function mount()
    {

    }

    public function save()
    {
        $createCategory = $this->form->store();
        
        if($createCategory){
            $this->dispatch('refresh-table-create');
            $this->closeModal();
        }

    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->form->reset();
        $this->resetValidation();
        $this->reset('subCategory');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->form->reset();
        $this->resetValidation();
        $this->reset('subCategory');
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('user_id', auth()->id())
            ->get();
    }

    public function render()
    {
        return view('livewire.category.category-create');
    }
}
