@extends('layouts.master')
@section('title', 'Dashboard Transaksi')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('addStyle')
<link href="{{ asset('css/lib/dropzone/dropzone.css') }}" rel="stylesheet">
<link href="{{ asset('css/lib/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/lib/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-primary">Dashboard Transaksi</h4>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @include('partials.notification')

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Transaction List</a> </li>
                        @if(Auth::user()->staff_position <= 6)
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Add Transaction</a> </li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="list" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                @if(Auth::user()->staff_position == 6)
                                                <th>Act</th>
                                                @endif
                                                <th>Invoice</th>
                                                <th>Outlet</th>
                                                <th>Capster</th>
                                                <th>Customer Name</th>
                                                <th>Date</th>
                                                <th>Total (Rp)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $transaction)
                                                <tr>
                                                    @if(Auth::user()->staff_position == 6)
                                                    <td>
                                                        <div class="sweetalert">
                                                            <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('transaction','{{ $transaction->id }}')"><i class="fa fa-times"></i></button>
                                                            <a class="btn btn-default btn-xs" href="{{ url('transaction/edit/'.$transaction->id) }}"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td>{{ $transaction -> invoice }}</td>
                                                    <td>
                                                        {{ $transaction -> outlet-> outlet_id }}
                                                        <br>
                                                        {{ $transaction -> outlet-> address }}, {{ $transaction -> outlet ->districts -> name }}
                                                        <br>
                                                        {{ $transaction->outlet->regencies->name }}
                                                    </td>
                                                    <td>{{ $transaction -> capster -> name }}</td>
                                                    <td>{{ $transaction -> customer -> name }}</td>
                                                    <td>
                                                        {{ date_format($transaction -> created_at,"d-M-y") }}
                                                        <br>
                                                        {{ date_format($transaction -> created_at,"H:i A") }}
                                                    </td>
                                                    <td>{{ number_format($transaction -> getTotalPriceAfterDiscount(),2,",",".") }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <form id="del_form" action="#" method="post">
                                {{ csrf_field() }}
                            </form>

                        </div>
                        @if(Auth::user()->staff_position <= 6)
                        <div class="tab-pane" id="add" role="tabpanel">
                            
                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('transaction/input') }}" method="post">
                                <div class="row m-t-30">
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="invoice_num">Invoice <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="invoice_num" name="invoice_num" value="{{ $rand['invoice_num'] }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="outlet_id">Outlet <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="outlet_id" name="outlet_id" onchange="getOutletInfo()">
                                                            <option value="">Select Outlet</option>
                                                            @foreach($outlets as $outlet)
                                                                <option value="{{ $outlet->id }}">{{ $outlet->outlet_id }} - {{ $outlet->address }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="capster_id">Capster <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="capster_id" name="capster_id">
                                                            <option value="">Select Capster</option>
                                                           
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="master_discount">Master Discount (%)<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="number" class="form-control input-sm" id="master_discount" name="master_discount" value="0" onkeyup="masterDiscount()">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="total_payment">Total Payment<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="number" class="form-control input-sm" id="total_payment" name="total_payment" value="0" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary m-t-15">Save</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="customer_id">Customer ID<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="customer_id" name="customer_id" value="{{ $rand['customer_id'] }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="customer_name">Customer Name<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="customer_name" name="customer_name" placeholder="Type customer name...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="customer_job">Customer Job<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="customer_job" name="customer_job" placeholder="Type customer Job...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="customer_address">Customer Address<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="customer_address" name="customer_address" placeholder="Type customer address...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="customer_phone_number">Customer Phone Number<span class="text-danger"></span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="customer_phone_number" name="customer_phone_number" placeholder="Type customer phone number..." >
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="form-validation">
                                                
                                                <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">
                                                            <table id="transaction_detail_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Service</th>
                                                                        <th>Price</th>
                                                                        <th>Qty</th>
                                                                        <th>Discount (%)</th>
                                                                        <th>Subtotal</th>
                                                                        <th>Act</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="row_1">
                                                                        <td id="row_num_1">1</td>
                                                                        <td id="service_num_1">
                                                                            <select class="form-control input-sm" name="service_1" id="service_1" onchange="getPrice(1)">
                                                                                <option value="">Select Service</option>
                                                                            </select>
                                                                        </td>
                                                                        <td id="price_num_1">
                                                                            <input type="text" class="form-control input-sm" id="price_1" name="price_1" value="0" readonly>
                                                                        </td>
                                                                        <td id="qty_num_1">
                                                                            <input type="text" class="form-control input-sm" id="qty_1" name="qty_1" value="0" onkeyup="countSubtotal(1)">
                                                                        </td>
                                                                        <td id="discount_num_1">
                                                                            <input type="text" class="form-control input-sm" id="discount_1" name="discount_1" value="0" onkeyup="countSubtotal(1)">
                                                                        </td>
                                                                        <td id="subtotal_num_1">
                                                                            <input type="text" class="form-control input-sm" id="subtotal_1" name="subtotal_1" value="0" readonly>
                                                                        </td>
                                                                        <td id="remove_num_1">
                                                                            <button id="remove_1" type="button" class="btn btn-xs btn-danger" onclick="removeRow(1)"><i class="fa fa-times" ></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-2 ml-auto">
                                                        <button type="button" class="btn btn-primary m-t-15" onclick="addRow()">Add Row</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>
                                {{ csrf_field() }}
                                <input type="hidden" name="transaction_detail_row" id="transaction_detail_row" value="1">
                            </form>
                            
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Content -->

    </div>
    <!-- End Container fluid  -->
    <!-- footer -->
    <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
    <!-- End footer -->
</div>

@endsection

@section('addScript')

<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!};
var PRICES = [] ;
var TRANDETROW = 1 ;
</script>

<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.js') }}"></script>
<script src="{{ asset('js/dashboard/transaction.js') }}"></script>

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