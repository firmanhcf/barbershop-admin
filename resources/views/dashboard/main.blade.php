@extends('layouts.master')
@section('title', 'Main Dashboard')

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
                            <p class="m-b-0">of {{ number_format($transactionToday,0,",",".") }} transaction(s) today</p>
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
                            <p class="m-b-0">of {{ number_format($transactionThisMonth,0,",",".") }} transaction(s) this month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Transactions</h4>
                    </div>
                    
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#today" role="tab"><i class="fa fa-table"></i> Today</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#month" role="tab"><i class="fa fa-table"></i> This Month</a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="today" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Province</th>
                                                <th>Outlet</th>
                                                <th>Capster</th>
                                                <th>Customer Name</th>
                                                <th>Discount (%)</th>
                                                <th>Total (Rp)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactionsOfToday as $transaction)
                                                <tr>

                                                    <td>
                                                        {{ date_format($transaction -> created_at,"d-M-y") }}
                                                        <br>
                                                        {{ date_format($transaction -> created_at,"H:i A") }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->outlet->provinces->name }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->outlet->outlet_id }}
                                                        <br>
                                                        {{ $transaction->outlet->address }}, {{ $transaction->outlet->districts->name }}
                                                        <br>
                                                        {{ $transaction->outlet->regencies->name }}
                                                    </td>
                                                    <td>{{ $transaction -> capster -> name }}</td>
                                                    <td>{{ $transaction -> customer -> name }}</td>
                                                    <td>{{ $transaction -> discount }}</td>
                                                    <td>{{ number_format($transaction -> getTotalPriceAfterDiscount(),2,",",".") }}</td>
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
                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Province</th>
                                                <th>Outlet</th>
                                                <th>Capster</th>
                                                <th>Customer Name</th>
                                                <th>Discount (%)</th>
                                                <th>Total (Rp)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactionsOfThisMonth as $transaction)
                                                <tr>

                                                    <td>
                                                        {{ date_format($transaction -> created_at,"d-M-y") }}
                                                        <br>
                                                        {{date_format($transaction -> created_at,"H:i A") }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->outlet->provinces->name }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->outlet->outlet_id }}
                                                        <br>
                                                        {{ $transaction->outlet->address }}, {{ $transaction->outlet->districts->name }}
                                                        <br>
                                                        {{ $transaction->outlet->regencies->name }}
                                                    </td>
                                                    <td>{{ $transaction -> capster -> name }}</td>
                                                    <td>{{ $transaction -> customer -> name }}</td>
                                                    <td>{{ $transaction -> discount }}</td>
                                                    <td>{{ number_format($transaction -> getTotalPriceAfterDiscount(),2,",",".") }}</td>
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