@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-4 mb-4 order-1">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Congratulations Admin SCPK 1! 🎉</h5>
                                <p class="mb-4">
                                    You have successfully implemented the <span class="fw-bold">Simple Additive Weighting
                                        (SAW)</span>
                                    method using the <span class="fw-bold">Laravel framework!</span>🚀
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 order-1 mb-4">
                <div class="overflow-auto">
                    <div class="d-flex flex-nowrap">
                        <!-- Card 1 -->
                        <div class="card me-3" style="width: 247.5px; flex: 0 0 auto;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/database.png" alt="chart success"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Dataset</span>
                                <h3 class="card-title mb-2">{{ $dataset }}</h3>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card me-3" style="width: 247.5px; flex: 0 0 auto;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/kriteria.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span>Criteria</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $criteria }}</h3>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="card me-3" style="width: 247.5px; flex: 0 0 auto;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/sub-kriteria.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span>Sub Criteria</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $subKriteria }}</h3>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="card me-3" style="width: 247.5px; flex: 0 0 auto;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/alternatif.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span>Alternatif</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $alternatif }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <!-- Top 5 Alternatif SAW -->
            <div class="col-12 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-10">
                            <h5 class="m-0 me-2">Top 5 Hasil SAW</h5>
                            <small class="text-muted">Alternatif dengan nilai tertinggi</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @foreach ($top5 as $rank => $item)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">{{ $rank + 1 }}</span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $item['alternatif'] }}</h6>
                                            <small class="text-muted">Nilai: {{ $item['nilai'] }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">Rank #{{ $rank + 1 }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- /Top 5 Alternatif SAW -->

        </div>
    </div>
@endsection
