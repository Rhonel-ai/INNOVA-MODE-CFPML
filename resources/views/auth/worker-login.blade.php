@extends('layouts.admin.site')

@section('content')
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-header text-center">
            <h3>Connexion Ouvrier JobZone</h3>
        </div>
        <div class="card-body">
            @if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('worker.login') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection