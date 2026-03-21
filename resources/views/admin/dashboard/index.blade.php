@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">

    <!-- Title -->
    <h1 class="h2">
        {{ Auth::user()->email }}
    </h1>

    <div class="row">
        <div class="col-xxl-5">
            <div class="row">
                <div class="col-md-6">

                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-between">

                                    <div>
                                        <!-- Title -->
                                        <h5
                                            class="d-flex align-items-center text-uppercase text-body-secondary fw-sembold mb-2">
                                            <span class="legend-circle-sm bg-success"></span>
                                            Income
                                        </h5>

                                        <!-- Subtitle -->
                                        <h2 class="mb-0">
                                            $3,24
                                        </h2>

                                        <!-- Comment -->
                                        <p class="fs-6 text-body-secondary mb-0">
                                            No additional income
                                        </p>
                                    </div>

                                    <span class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" height="32"
                                            width="32">
                                            <defs>
                                                <style>
                                                .a {
                                                    fill: none;
                                                    stroke: currentColor;
                                                    stroke-linecap: round;
                                                    stroke-linejoin: round;
                                                    stroke-width: 1.5px;
                                                }
                                                </style>
                                            </defs>
                                            <title>cash-briefcase</title>
                                            <path class="a"
                                                d="M9.75,15.937c0,.932,1.007,1.688,2.25,1.688s2.25-.756,2.25-1.688S13.243,14.25,12,14.25s-2.25-.756-2.25-1.688,1.007-1.687,2.25-1.687,2.25.755,2.25,1.687">
                                            </path>
                                            <line class="a" x1="12" y1="9.75" x2="12" y2="10.875"></line>
                                            <line class="a" x1="12" y1="17.625" x2="12" y2="18.75"></line>
                                            <rect class="a" x="1.5" y="6.75" width="21" height="15" rx="1.5" ry="1.5">
                                            </rect>
                                            <path class="a"
                                                d="M15.342,3.275A1.5,1.5,0,0,0,13.919,2.25H10.081A1.5,1.5,0,0,0,8.658,3.275L7.5,6.75h9Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-between">

                                    <div>
                                        <!-- Title -->
                                        <h5
                                            class="d-flex align-items-center text-uppercase text-body-secondary fw-semibold mb-2">
                                            <span class="legend-circle-sm bg-danger"></span>
                                            Expense
                                        </h5>

                                        <!-- Subtitle -->
                                        <h2 class="mb-0">
                                            $1,500
                                        </h2>

                                        <!-- Comment -->
                                        <p class="fs-6 text-body-secondary mb-0 text-truncate">
                                            + $6.50 bank charges fee
                                        </p>
                                    </div>

                                    <span class="text-primary">
                                        <svg viewbox="0 0 24 24" height="32" width="32"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.75,14.25H16.717a1.342,1.342,0,0,0-.5,2.587l2.064.826a1.342,1.342,0,0,1-.5,2.587H15.75"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                            <path d="M17.25 14.25L17.25 13.5" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path d="M17.25 21L17.25 20.25" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path
                                                d="M11.250 17.250 A6.000 6.000 0 1 0 23.250 17.250 A6.000 6.000 0 1 0 11.250 17.250 Z"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                            <path d="M3.75 14.25L8.25 14.25" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path d="M8.25 14.25L8.25 6.75" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path d="M11.25 9.75L11.25 8.25" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path d="M5.25 14.25L5.25 9.75" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path
                                                d="M7.5,20.25H2.25a1.43,1.43,0,0,1-1.5-1.415V2.335A1.575,1.575,0,0,1,2.25.75H12.879a1.5,1.5,0,0,1,1.06.439l2.872,2.872a1.5,1.5,0,0,1,.439,1.06V7.5"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>

        <div class="col-xxl-7">
            <div class="row">
                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">

                                    <!-- Title -->
                                    <h5 class="text-uppercase text-body-secondary fw-semibold mb-2">
                                        Total
                                    </h5>

                                    <!-- Subtitle -->
                                    <h2 class="mb-0">
                                        $74,925
                                    </h2>

                                    <!-- Comment -->
                                    <p class="fs-6 text-body-secondary mb-0 text-truncate">

                                        <!-- Badge -->
                                        <span class="badge text-bg-success-soft fs-6 fw-bold mb-n1">
                                            <svg viewbox="0 0 24 24" height="10" width="10"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M23.25 12.75L23.25 6 16.5 6" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                                </path>
                                                <path
                                                    d="M23.25,6l-7.939,7.939a1.5,1.5,0,0,1-2.122,0l-3.128-3.128a1.5,1.5,0,0,0-2.122,0L.75,18"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"></path>
                                            </svg>
                                            12%
                                        </span>
                                        from $65,934
                                    </p>
                                </div>

                                <div class="col-6">

                                    <!-- Chart -->
                                    <div class="chart-container h-70px">
                                        <canvas id="incomeChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col">

                                    <!-- Title -->
                                    <h5
                                        class="text-uppercase text-body-secondary fw-semibold mb-2 d-flex align-items-center">
                                        Pageviews

                                        <!-- Icon -->
                                        <a href="javascript: void(0);" class="ms-2 text-secondary"
                                            data-bs-toggle="tooltip"
                                            title="Pageviews is a metric defined as the total number of pages viewed.">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" height="14"
                                                width="14">
                                                <path
                                                    d="M12,0A12,12,0,1,0,24,12,12,12,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,0,1,0,2Z"
                                                    style="fill: currentColor"></path>
                                            </svg>
                                        </a>
                                    </h5>

                                    <!-- Subtitle -->
                                    <h2 class="mb-0">
                                        123,598
                                    </h2>

                                    <!-- Comment -->
                                    <p class="fs-6 text-body-secondary mb-0">

                                        <!-- Badge -->
                                        <span class="badge text-bg-danger-soft fs-6 fw-bold mb-n1">
                                            <svg viewbox="0 0 24 24" height="10" width="10"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M23.25 11.25L23.25 18 16.5 18" fill="none"
                                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"></path>
                                                <path
                                                    d="M23.25,18l-7.939-7.939a1.5,1.5,0,0,0-2.122,0l-3.128,3.128a1.5,1.5,0,0,1-2.122,0L.75,6"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"></path>
                                            </svg>
                                            9.2%
                                        </span>
                                        from 134,969
                                    </p>
                                </div>
                                <div class="col-5">

                                    <!-- Chart -->
                                    <div class="chart-container h-65px">
                                        <canvas id="pageViewsChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>
    </div> <!-- / .row -->

    <div class="row">
        <div class="col d-flex">

            <div class="card border-0 flex-fill w-100"
                data-list='{"valueNames": ["fullname","school","city","votes","code","created"],"page":10}'
                id="candidatesTable">

                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <h2 class="card-header-title h4 text-uppercase m-0">Liste des candidats</h2>

                    <input class="form-control list-fuzzy-search mw-md-300px" type="search" placeholder="Rechercher..."
                        id="searchInput">
                </div>

                <div class="table-responsive">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                    @endif

                    <table class="table align-middle table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Photo</th>

                                <th>
                                    <a href="#" class="list-sort" data-sort="fullname">Nom & Prénoms</a>
                                </th>

                                <th>
                                    <a href="#" class="list-sort" data-sort="school">École</a>
                                </th>

                                <th>
                                    <a href="#" class="list-sort" data-sort="city">Ville</a>
                                </th>

                                <th>
                                    <a href="#" class="list-sort" data-sort="votes">Votes</a>
                                </th>

                                <th>
                                    <a href="#" class="list-sort" data-sort="created">birth_date</a>
                                </th>
                                <th>
                                    <a href="#" class="list-sort" data-sort="created">created_at</a>
                                </th>

                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach($candidates as $candidate)
                            <tr>

                                <!-- Photo -->
                                <td>
                                    @if($candidate->image)
                                    <img src="{{ asset('uploads/candidates/'.$candidate->image) }}"
                                        alt="{{ $candidate->first_name }}" class="rounded-circle" width="45" height="45"
                                        style="object-fit: cover;">
                                    @else
                                    <span class="badge bg-secondary">Aucun</span>
                                    @endif
                                </td>

                                <!-- Nom complet -->
                                <td class="fullname">
                                    {{ $candidate->last_name }} {{ $candidate->first_name }}
                                </td>

                                <!-- École -->
                                <td class="school">{{ $candidate->school }}</td>

                                <!-- Ville -->
                                <td class="city">{{ $candidate->city }}</td>

                                <!-- Votes -->
                                <td class="votes">
                                    {{ $candidate->votes }}
                                </td>

                                <td class="votes">
                                    {{ $candidate->birth_date }}
                                </td>

                                <!-- Date création -->

                                <td class="created" data-created="{{ $candidate->created_at->timestamp }}">
                                    {{ $candidate->created_at->format('d/m/Y') }}
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">⋮</a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('candidates.show', $candidate->id) }}">
                                                    Voir
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{ route('candidates.destroy', $candidate->id) }}"
                                                    method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item text-danger btn-delete">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Recherche JS -->
                    <script>
                    document.getElementById('searchInput').addEventListener('input', function() {
                        let filter = this.value.toLowerCase();
                        let rows = document.querySelectorAll('table tbody tr');

                        rows.forEach(row => {
                            let text = row.textContent.toLowerCase();
                            row.style.display = text.includes(filter) ? '' : 'none';
                        });
                    });
                    </script>

                </div>

                <div class="card-footer">
                    <ul class="pagination justify-content-end list-pagination mb-0"></ul>
                </div>

            </div>
        </div>
    </div>






    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // empêche le submit immédiat

            const form = this.closest('form'); // récupère le formulaire lié au bouton

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                width: '350px',
                padding: '1em',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // 🔹 soumet le formulaire si confirmé
                }
            });
        });
    });
    </script>

</div> <!-- / .container-fluid -->

@endsection