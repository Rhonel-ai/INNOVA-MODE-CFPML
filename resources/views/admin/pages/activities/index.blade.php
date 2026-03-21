@extends('layouts.admin.app')

@section('content')



<div class="container-fluid">

    <div class="d-flex align-items-baseline justify-content-between">

        <!-- Title -->
        <h1 class="h2">
            Liste des des activités du sites
        </h1>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <a class="btn btn-sm btn-secondary mt-2" onclick="history.back()" href="#">Back</a>
            </ol>
        </nav>
    </div>
    @if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>
    @endif

    <div class="row">
        <div class="col d-flex">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100"
                data-list='{"valueNames": ["name", {"name": "key", "attr": "data-key"}, {"name": "status", "attr": "data-status"}, {"name": "created", "attr": "data-created"}], "page": 10}'
                id="keysTable">
                <div class="card-header border-0">

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">

                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase m-5">
                            Activites
                        </h2>
                        <!-- Avatar group -->


                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0"
                            type="search" placeholder="Search in keys">




                    </div>

                </div>

                <!-- Table -->
                <div class="table-responsive">

                    <table class=" table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort"
                                        data-sort="name">
                                        logs names
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort"
                                        data-sort="name">
                                        Action effectuée
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort"
                                        data-sort="key">
                                        Nom de la personne
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort"
                                        data-sort="key">
                                        Models
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort"
                                        data-sort="key">
                                        Date & Heure
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($activities as $activity)
                            <tr>
                                <td>{{ $activity->log_name }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->causer->name }}</td>
                                <td>{{ $activity->subject_type }}</td>
                                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div> <!-- / .table-responsive -->

                <div class="card-footer">
                    <!-- Pagination -->
                    <ul class="pagination justify-content-end list-pagination mb-0"></ul>
                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>




@endsection