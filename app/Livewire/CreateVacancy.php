<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Vacancy;
use App\Models\Wage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVacancy extends Component
{
    public $title;
    public $wage_id;
    public $category_id;
    public $business;
    public $last_day;
    public $description;
    public $image;

    use WithFileUploads;

    protected $rules = [
        'title'=>['required', 'string'],
        'wage_id'=>['required'],
        'category_id'=>['required'],
        'business'=>['required'],
        'last_day'=>['required'],
        'description'=>['required'],
        'image'=>['required', 'image', 'max:1024'],
    ];

    protected $messages = [
        'title.required' => 'El Titulo es requerido',
        'wage_id.required' => 'El Salario es requerido',
        'category_id.required' => 'La Categoría es requerida',
        'business.required' => 'La Empresa es requerida',
        'last_day.required' => 'El Ultimo dia de aplicación es requerido',
        'description.required' => 'La Descripción es requerida',
        'image.required' => 'La Imagen es requerida',
        'image.image' => 'El archivo no es de tipo imagen',
        'image.max' => 'La Imagen es demasiado grande',
    ];

    public function render()
    {
        $wages = Wage::all();
        $categories = Category::all();

        return view('livewire.create-vacancy',[
            'wages' => $wages,
            'categories' => $categories,
        ]);
    }

    public function createVacancy(){
        $data = $this->validate();

        $image = $this->image->store('public/vacancies');
        $name_image = str_replace('public/vacancies/', '', $image);

        Vacancy::create([
            ...$data,
            'user_id' => auth()->user()->id,
            'image' => $name_image,
        ]);

        session()->flash('message', 'La Vacante se publico correctamente');

        return redirect()->route('vacancies.index');
    }
}
