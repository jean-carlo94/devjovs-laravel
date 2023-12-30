<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Wage;
use App\Models\Vacancy;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditVacancy extends Component
{
    public $vacancy_id;
    public $title;
    public $wage_id;
    public $category_id;
    public $business;
    public $last_day;
    public $description;
    public $image;
    public $new_image;

    use WithFileUploads;

    protected $rules = [
        'title'=>['required', 'string'],
        'wage_id'=>['required'],
        'category_id'=>['required'],
        'business'=>['required'],
        'last_day'=>['required'],
        'description'=>['required'],
        'new_image'=>['nullable', 'image', 'max:1024'],
    ];

    protected $messages = [
        'title.required' => 'El Titulo es requerido',
        'wage_id.required' => 'El Salario es requerido',
        'category_id.required' => 'La Categoría es requerida',
        'business.required' => 'La Empresa es requerida',
        'last_day.required' => 'El Ultimo dia de aplicación es requerido',
        'description.required' => 'La Descripción es requerida',
        'new_image.image' => 'El archivo no es de tipo imagen',
        'new_image.max' => 'La Imagen es demasiado grande',
    ];

    public function mount(Vacancy $vacancy){
        $this->vacancy_id = $vacancy->id;
        $this->title = $vacancy->title;
        $this->wage_id = $vacancy->wage_id;
        $this->category_id = $vacancy->category_id;
        $this->business = $vacancy->business;
        $this->last_day = Carbon::parse($vacancy->last_day)->format('Y-m-d');
        $this->description = $vacancy->description;
        $this->image = $vacancy->image;
    }

    public function render()
    {
        $wages = Wage::all();
        $categories = Category::all();

        return view('livewire.edit-vacancy',[
            'wages' => $wages,
            'categories' => $categories,
        ]);
    }

    public function editVacancy(){
        $data = $this->validate();

        $vacancy = Vacancy::find($this->vacancy_id);

        if($this->new_image){
            $image = $this->new_image->store('public/vacancies');
            Storage::delete('public/vacancies/' . $vacancy->image);

            $data['image'] = str_replace('public/vacancies/','',$image);
        };

        foreach ($vacancy->getAttributes() as $key => $value) {
            if(array_key_exists($key, $data)){
                $vacancy->$key = $data[$key];
            };
        };

        $vacancy->save();

        session()->flash('message', 'La vacante se actualizo correctamente');
        return redirect()->route('vacancies.index');
    }
}
