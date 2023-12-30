<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Wage;
use Livewire\Component;

class SearchVacancies extends Component
{

    public $term;
    public $category;
    public $wage;

    public function readFormData() {
        $this->dispatch('searchToTerms', $this->term, $this->category, $this->wage);
    }

    public function render(){
        $wages = Wage::all();
        $categories = Category::all();

        return view('livewire.search-vacancies', [
            'wages' => $wages,
            'categories' => $categories,
        ]);
    }
}
