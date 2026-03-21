@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Créer un candidat</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Prénoms</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">École</label>
                <input type="text" name="school" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Ville</label>
                <input type="text" name="city" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="birth_date" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Photo du candidat</label>
                <input type="file" name="image" class="form-control">
            </div>

        </div>

        <button class="btn btn-primary mt-3">
            Enregistrer le candidat
        </button>

    </form>
</div>
@endsection