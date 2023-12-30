<?php

namespace App\Livewire;

use App\Models\Vacancy;
use App\Notifications\NewCandidate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApplyVacancy extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacancy;

    protected $rules = [
        'cv' => ['required', 'mimes:pdf']
    ];

    public function mount(Vacancy $vacancy){
        $this->vacancy = $vacancy;
    }

    public function apply(){
        $this->validate();

        //Almacenar archivo
        $data = $this->validate();

        $cv = $this->cv->store('public/cv');
        $name_cv = str_replace('public/cv/', '', $cv);

        //Crear Candidato a la vacante
        $this->vacancy->candidates()->create([
            'user_id' => auth()->user()->id,
            'cv' => $name_cv,
        ]);

        //Notificación
        $this->vacancy->recruiter->notify(
            new NewCandidate(
                $this->vacancy->id,
                $this->vacancy->title,
                auth()->user()->id
            )
        );

        //Mostrar el usuario un mensaje de OK
        session()->flash('message', 'Has aplicado correctamente a la vacante, Mucha suerte');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.apply-vacancy');
    }
}
