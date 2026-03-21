@extends('layouts.admin.app')
@section('content')

<div class="container-fluid">

    <div class="d-flex align-items-baseline justify-content-between">

        <!-- Title -->
        <h1 class="h2">
            Show User
        </h1>
        <div class="pull-right">

        </div>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <a class="btn btn-sm btn-secondary mt-2" onclick="history.back()" href="#">Back</a>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-xl-9 d-flex">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body p-7">
                    <div class="row align-items-center h-100">
                        <div class="col-auto d-flex ms-auto ms-md-0">
                            <div class="avatar avatar-circle avatar-xxl">
                                @if($user->upload)
                                <img src=" {{ asset('storage/uploads/'.$user->upload) }}" alt="profil" width="112"
                                    height="112" class="rounded-circle" style="object-fit:cover;">
                                @else

                                <div class="avatar-circle avatar-xxl upload-default">
                                    <span class="avatar-title text-bg-secondary">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                @endif

                            </div>
                        </div>

                        <div class="col-auto me-auto d-flex flex-column">
                            <h3 class="mb-0">{{ $user->name }}</h3>
                            <!-- <h3 class="mb-0">Name: {{ $user->status }}</h3> -->

                            <span class="small text-secondary fw-bold d-block mb-4">@if(!empty($user->getRoleNames()))

                                @foreach($user->getRoleNames() as $v)

                                <p class="text-secondary mb-0">{{ $v }}</p>

                                @endforeach
                                @endif
                            </span>

                            <div class="d-flex">

                                <!-- Button -->
                                <button type="button" class="btn btn-primary btn-sm me-2">Message</button>

                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <a href="javascript: void(0);"
                                        class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center btn-light rounded-circle ms-2 text-body w-30px h-30px"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" height="16"
                                            width="16">
                                            <g>
                                                <circle cx="3.25" cy="12" r="3.25" style="fill: currentColor"></circle>
                                                <circle cx="12" cy="12" r="3.25" style="fill: currentColor"></circle>
                                                <circle cx="20.75" cy="12" r="3.25" style="fill: currentColor"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end"
                                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-7.5px, 18px, 0px);">
                                        <a href="javascript: void(0);" class="dropdown-item">
                                            Action
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">
                                            Another action
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">
                                            Something else here
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                            <div class="hstack d-inline-flex gap-6">
                                <div>
                                    <h4 class="h2 mb-0">Email</h4>
                                    <p class="text-secondary mb-0"> {{ $user->email }}</p>
                                </div>

                                <div>
                                    <h4 class="h2 mb-0">nbrUser</h4>
                                    <p class="mb-0">{{$nbrUser}} utilisateur</p>

                                </div>

                                <div>
                                    <h4 class="h2 mb-0">Role</h4>

                                    @if(!empty($user->getRoleNames()))

                                    @foreach($user->getRoleNames() as $v)

                                    <p class="text-secondary mb-0">{{ $v }}</p>

                                    @endforeach

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> <!-- / .row -->

                </div>
            </div>
        </div>
        <div class="col-xl-3 d-flex">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body text-center">
                    <div class="row align-items-center h-100">
                        <div class="col">
                            <small class="text-secondary">Mise a jour profile</small>

                            <!-- Chart -->
                            <div class="chart-container w-100px h-100px mx-auto mt-3">
                                <canvas id="profileCompletionChart"></canvas>

                                <!-- Labels -->
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <h3 class="mb-0"
                                        style="position:absolute;top:50%;left: 50%;transform: translate(-50%, -50%);font-size: 24px;font-weight: bold;">
                                        {{round($progress)}}%</h3>
                                </div>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div> <!-- / .row -->

</div>


<div style="width: 100px;height: 100px;border-radius:50%;border: 10px; solid">
    <!-- <svg with="100" height="100">
        <circle cx="50" cy="50" r="45" stroke="
        <circle cx=" 50" cy="50" r="45" stroke="#4CAF50" stroke-width="10" fill="none" stroke-dasharray="283"
            stroke-dashoffset="{{283-(283* $progress / 100)}}" />
    </svg> -->
    <!-- <span>{{round($progress)}}%</span> -->
</div>

@endsection