<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;

class RegisterWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;

    // Étape 1 : infos perso
    public $first_name, $last_name, $phone, $email, $password;

    // Étape 2 : métier
    public $profession, $skills, $experience_years;

    // Étape 3 : localisation
    public $city, $neighborhood, $zone;

    // Étape 4 : documents
    public $photo, $id_card, $cv;

    // Validation dynamique
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules());
    }

    public function rules()
    {
        if ($this->currentStep == 1) {
            return [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'phone'      => 'required|string|max:20',
                'email'      => 'required|email',
                'password'   => 'required|string|min:6',
            ];
        } elseif ($this->currentStep == 2) {
            return [
                'profession'       => 'required|string|max:255',
                'skills'           => 'required|string',
                'experience_years' => 'required|integer|min:0',
            ];
        } elseif ($this->currentStep == 3) {
            return [
                'city'         => 'required|string|max:255',
                'neighborhood' => 'required|string|max:255',
                'zone'         => 'required|string|max:255',
            ];
        } elseif ($this->currentStep == 4) {
            return [
                'photo'   => 'nullable|image|max:1024',
                'id_card' => 'nullable|image|max:1024',
                'cv'      => 'nullable|mimes:pdf,doc,docx|max:2048',
            ];
        }

        return [];
    }

    // Passer à l'étape suivante
    public function increaseStep()
    {
        $this->validate($this->rules());

        // Vérifier si l'email existe déjà à l'étape 1
        if ($this->currentStep == 1) {
            $existingWorker = Worker::where('email', $this->email)->first();
            if ($existingWorker) {
                session()->flash('message', 'Vous avez déjà un compte. Connectez-vous.');
                return redirect()->route('worker.login'); // redirige vers login des ouvriers
            }
        }

        $this->currentStep++;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
    }

    // Soumettre le formulaire
    public function submit()
    {
        $this->validate($this->rules());

        Worker::create([
            'first_name'       => $this->first_name,
            'last_name'        => $this->last_name,
            'phone'            => $this->phone,
            'email'            => $this->email,
            'password'         => Hash::make($this->password),
            'profession'       => $this->profession,
            'skills'           => $this->skills,
            'experience_years' => $this->experience_years,
            'city'             => $this->city,
            'neighborhood'     => $this->neighborhood,
            'zone'             => $this->zone,
            'photo'            => $this->photo ? $this->photo->store('photos', 'public') : null,
            'id_card'          => $this->id_card ? $this->id_card->store('id_cards', 'public') : null,
            'cv'               => $this->cv ? $this->cv->store('cvs', 'public') : null,
        ]);

        session()->flash('message', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
        return redirect()->route('worker.login');
    }

    public function render()
    {
        return view('livewire.register-wizard');
    }
}