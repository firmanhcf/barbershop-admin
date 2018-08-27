@extends('layouts.master')
@section('title', 'Dashboard Utama')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('addStyle')
<link href="{{ asset('css/lib/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-primary">Dashboard Utama</h4>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            
            <div class="col-md-6">
                <div class="card bg-success p-20">
                    <div class="media widget-ten">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-stats-up f-s-40"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2 class="color-white">Rp. {{ empty($revenueToday[0]->after_discount)?'0':number_format($revenueToday[0]->after_discount,2,",",".") }}</h2>
                            <p class="m-b-0">dari {{ number_format($transactionToday,0,",",".") }} transaksi hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-danger p-20">
                    <div class="media widget-ten">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-stats-up f-s-40"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2 class="color-white">Rp. {{ empty($revenueThisMonth[0]->after_discount)?'0':number_format($revenueThisMonth[0]->after_discount,2,",",".") }}</h2>
                            <p class="m-b-0">dari {{ number_format($transactionThisMonth,0,",",".") }} transaksi bulan ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Transaksi</h4>
                    </div>
                    
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#today" role="tab"><i class="fa fa-table"></i> Hari ini</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#month" role="tab"><i class="fa fa-table"></i> Bulan ini</a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="today" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-data display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="15%">ID Outlet</th>
                                                <th rowspan="2" width="15%">Nama Outlet</th>
                                                <th rowspan="2" width="20%">Alamat</th>
                                                <th rowspan="2" width="15%">Kota/Kabupaten</th>
                                                <th colspan="4"><center>Transaksi</center></th>
                                                <th rowspan="2" width="15%">Total</th>
                                            </tr>
                                            <tr>
                                                <th width="25%">Potong Rambut</th>
                                                <th width="25%">Cukur Jenggot</th>
                                                <th width="25%">Refleksi</th>
                                                <th width="25%">Training</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactionsOfToday as $transaction)
                                                <tr>

                                                    <td width="15%">{{ $transaction->outlet_id }}</td>
                                                    <td width="15%">{{ $transaction->name }}</td>
                                                    <td width="20%">{{ $transaction->address }}</td>
                                                    <td width="15%">{{ $transaction->regency }}</td>
                                                    <td width="5%">{{ $transaction->hair_cut }}</td>
                                                    <td width="5%">{{ $transaction->shave }}</td>
                                                    <td width="5%">{{ $transaction->massage }}</td>
                                                    <td width="5%">{{ $transaction->training }}</td>
                                                    <td width="15%">{{ number_format($transaction -> total_after_discount,2,",",".") }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="month" role="tabpanel">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-data display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">ID Outlet</th>
                                                <th rowspan="2">Nama Outlet</th>
                                                <th rowspan="2">Alamat</th>
                                                <th rowspan="2">Kota/Kabupaten</th>
                                                <th colspan="4">Transaksi</th>
                                                <th rowspan="2">Total</th>
                                            </tr>
                                            <tr>
                                                <th>Potong Rambut</th>
                                                <th>Cukur Jenggot</th>
                                                <th>Refleksi</th>
                                                <th>Training</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactionsOfThisMonth as $transaction)
                                                <tr>

                                                    <td>{{ $transaction->outlet_id }}</td>
                                                    <td>{{ $transaction->name }}</td>
                                                    <td>{{ $transaction->address }}</td>
                                                    <td>{{ $transaction->regency }}</td>
                                                    <td>{{ $transaction->hair_cut }}</td>
                                                    <td>{{ $transaction->shave }}</td>
                                                    <td>{{ $transaction->massage }}</td>
                                                    <td>{{ $transaction->training }}</td>
                                                    <td>{{ number_format($transaction -> total_after_discount,2,",",".") }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- End Container fluid  -->
    
</div>

@endsection

@section('addScript')

<script src="{{ asset('js/lib/datamap/d3.min.js') }}"></script>
<script src="{{ asset('js/lib/datamap/topojson.js') }}"></script>
<script src="{{ asset('js/lib/datamap/datamaps.world.min.js') }}"></script>
<script src="{{ asset('js/lib/datamap/datamap-init.js') }}"></script>

<script src="{{ asset('js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('js/lib/weather/weather-init.js') }}"></script>
<script src="{{ asset('js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/lib/owl-carousel/owl.carousel-init.js') }}"></script>


<script src="{{ asset('js/lib/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('js/lib/chartist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('js/lib/chartist/chartist-init.js') }}"></script>

<script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/datatables-init.js') }}"></script>

@endsection