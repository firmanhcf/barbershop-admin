@extends('layouts.master')
@section('title', 'Edit Outlet')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('addStyle')
<link href="{{ asset('css/lib/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/lib/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-primary">Edit Partner</h4>
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

                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('transaction/edit/'.$transaction->id) }}" id="edit_form" method="post">
                        
                        <div class="row m-t-30">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="invoice_num">Invoice <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="invoice_num" name="invoice_num" value="{{ $transaction->invoice }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="outlet_id">Outlet <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="outlet_id" name="outlet_id" onchange="getOutletInfo()">
                                                    <option value="">Select Outlet</option>
                                                    @foreach($outlets as $outlet)
                                                        <option value="{{ $outlet->id }}" {{ ($outlet->id == $transaction->outlet_id)?'selected':'' }}>{{ $outlet->outlet_id }} - {{ $outlet->address }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="capster_id">Capster <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="capster_id" name="capster_id">
                                                    <option value="">Select Capster</option>
                                                    @foreach($capsters as $capster)
                                                        <option value="{{ $capster->id }}" {{ ($capster->id == $transaction->capster_id)?'selected':'' }}>{{ $capster->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="master_discount">Master Discount (%)<span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input type="number" class="form-control input-sm" id="master_discount" name="master_discount" value="{{ $transaction->discount }}" onkeyup="masterDiscount()">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_payment">Total Payment<span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input type="number" class="form-control input-sm" id="total_payment" name="total_payment" value="0" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto sweetalert">
                                                <button type="button" class="btn btn-primary m-t-15 sweet-confirm">Update</button>
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
                                                <input type="text" class="form-control input-sm" id="customer_id" name="customer_id" value="{{ $customer->customer_id }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="customer_name">Customer Name<span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="customer_name" name="customer_name" placeholder="Type customer name..." value="{{ $customer->name }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="customer_job">Customer Job<span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="customer_job" name="customer_job" placeholder="Type customer Job..." value="{{ $customer->job }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="customer_address">Customer Address<span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="customer_address" name="customer_address" placeholder="Type customer address..." value="{{ $customer->address }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="customer_phone_number">Customer Phone Number<span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="customer_phone_number" name="customer_phone_number" placeholder="Type customer phone number..." value="{{ $customer->phone_number }}">
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
                                                            <?php $no = 1; ?>
                                                            @foreach($transactionDetail as $item)
                                                            <tr id="row_{{$no}}">
                                                                <td id="row_num_{{$no}}">{{$no}}</td>
                                                                <td id="service_num_{{$no}}">
                                                                    <select class="form-control input-sm" name="service_{{$no}}" id="service_{{$no}}" onchange="getPrice({{$no}})">
                                                                        <option value="">Select Service</option>
                                                                        @foreach($prices as $price)
                                                                            <option value="{{$price['service_id']}}" {{($price['service_id']==$item->service_id."-".$item->service_type)?'selected':''}}>{{$price['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td id="price_num_{{$no}}">
                                                                    <input type="text" class="form-control input-sm" id="price_{{$no}}" name="price_{{$no}}" value="{{ $item -> price }}" readonly>
                                                                </td>
                                                                <td id="qty_num_{{$no}}">
                                                                    <input type="text" class="form-control input-sm" id="qty_{{$no}}" name="qty_{{$no}}" value="{{ $item -> qty }}" onkeyup="countSubtotal({{$no}})">
                                                                </td>
                                                                <td id="discount_num_{{$no}}">
                                                                    <input type="text" class="form-control input-sm" id="discount_{{$no}}" name="discount_{{$no}}" value="{{ $item -> discount }}" onkeyup="countSubtotal({{$no}})">
                                                                </td>
                                                                <td id="subtotal_num_{{$no}}">
                                                                    <input type="text" class="form-control input-sm" id="subtotal_{{$no}}" name="subtotal_{{$no}}" value="{{ ($item -> price * $item -> qty) - (($item -> discount/100) * ($item -> price * $item -> qty)) }}" readonly>
                                                                </td>
                                                                <td id="remove_num_{{$no}}">
                                                                    <button id="remove_{{$no}}" type="button" class="btn btn-xs btn-danger" onclick="removeRow({{$no}})"><i class="fa fa-times" ></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $no++; ?>
                                                            @endforeach
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
                        <input type="hidden" name="transaction_detail_row" id="transaction_detail_row" value="{!! count($transactionDetail) !!}">
                    </form>
                        
                </div>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <!-- End Container fluid  -->

</div>

@endsection

@section('addScript')

<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!};
var PRICES = '{{ $pricesStr }}';
var find = '&quot;';
var re = new RegExp(find, 'g');
PRICES = PRICES.replace(re,'"');
PRICES = JSON.parse(PRICES);
var TRANDETROW = {!! count($transactionDetail) !!} ;
</script>

<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.edit.js') }}"></script>
<script src="{{ asset('js/dashboard/transaction.js') }}"></script>

<script type="text/javascript">
masterDiscount();
</script>
@endsection