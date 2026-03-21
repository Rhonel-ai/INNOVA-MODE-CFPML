<div> {{-- Racine unique pour Livewire --}}
    @if (session()->has('message'))
    <div class="alert alert-warning">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-header text-center">
            <h3>Inscription Ouvrier JobZone</h3>
        </div>
        <div class="card-body">

            <!-- Barre de progression -->
            <div class="progress mb-4">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($currentStep/4)*100 }}%"
                    aria-valuenow="{{ $currentStep }}" aria-valuemin="1" aria-valuemax="4">
                    Étape {{ $currentStep }} sur 4
                </div>
            </div>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">

                <!-- Étape 1 -->
                @if ($currentStep == 1)
                <h5>Informations personnelles</h5>
                <input type="text" wire:model="first_name" placeholder="Nom" class="form-control mb-2">
                @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="text" wire:model="last_name" placeholder="Prénom" class="form-control mb-2">
                @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="text" wire:model="phone" placeholder="Téléphone" class="form-control mb-2">
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="email" wire:model="email" placeholder="Email" class="form-control mb-2">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="password" wire:model="password" placeholder="Mot de passe" class="form-control mb-2">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                @endif

                <!-- Étape 2 -->
                @if ($currentStep == 2)
                <h5>Métier / Compétences</h5>
                <input type="text" wire:model="profession" placeholder="Profession" class="form-control mb-2">
                @error('profession') <small class="text-danger">{{ $message }}</small> @enderror

                <textarea wire:model="skills" placeholder="Compétences" class="form-control mb-2"></textarea>
                @error('skills') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="number" wire:model="experience_years" placeholder="Années d'expérience"
                    class="form-control mb-2">
                @error('experience_years') <small class="text-danger">{{ $message }}</small> @enderror
                @endif

                <!-- Étape 3 -->
                @if ($currentStep == 3)
                <h5>Localisation</h5>
                <input type="text" wire:model="city" placeholder="Ville" class="form-control mb-2">
                @error('city') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="text" wire:model="neighborhood" placeholder="Quartier" class="form-control mb-2">
                @error('neighborhood') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="text" wire:model="zone" placeholder="Zone" class="form-control mb-2">
                @error('zone') <small class="text-danger">{{ $message }}</small> @enderror
                @endif

                <!-- Étape 4 -->
                @if ($currentStep == 4)
                <h5>Documents</h5>
                <input type="file" wire:model="photo" class="form-control mb-2">
                @error('photo') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="file" wire:model="id_card" class="form-control mb-2">
                @error('id_card') <small class="text-danger">{{ $message }}</small> @enderror

                <input type="file" wire:model="cv" class="form-control mb-2">
                @error('cv') <small class="text-danger">{{ $message }}</small> @enderror
                @endif

                <!-- Boutons -->
                <div class="mt-3">
                    @if($currentStep > 1)
                    <button type="button" wire:click="decreaseStep" class="btn btn-secondary">Précédent</button>
                    @endif

                    @if($currentStep < 4) <button type="button" wire:click="increaseStep" class="btn btn-primary">
                        Suivant</button>
                        @else
                        <button type="submit" class="btn btn-success">Terminer</button>
                        @endif
                </div>
            </form>

        </div>
    </div>
</div>