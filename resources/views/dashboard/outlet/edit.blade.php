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

                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('outlet/edit/'.$outlet->id) }}" id="edit_form" method="post">
                        <div class="row m-t-30">
                            
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="outlet_id">Outlet ID <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="outlet_id" name="outlet_id" value="{{ $outlet->outlet_id }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="province">Province <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="province" name="province" onchange="getRegency()">
                                                    <option value="">Select Province</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}" {{ ($province->id == $outlet->province)?'selected':'' }}>{{ ucwords($province->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="regency">Regency <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="regency" name="regency" onchange="getDistrict()">
                                                    <option value="">Select Regency</option>
                                                    @foreach($regencies as $regency)
                                                        <option value="{{ $regency->id }}" {{ ($regency->id == $outlet->regency)?'selected':'' }}>{{ ucwords($regency->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="district">District <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="district" name="district">
                                                    <option value="">Select District</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}" {{ ($district->id == $outlet->district)?'selected':'' }}>{{ ucwords($district->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Address <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="address" name="address" value="{{ $outlet->address }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="telephone_number">Telephone Number <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="telephone_number" name="telephone_number" value="{{ $outlet->telephone_number }}">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="partner_id">Owner <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="partner_id" name="partner_id">
                                                    <option value="">Select Owner</option>
                                                    @foreach($partners as $partner)
                                                        <option value="{{ $partner->id }}" {{ ($partner->id == $outlet->partner_id)?'selected':'' }}>{{ $partner->partner_id }} - {{ $partner->owner_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="partnership_id">Partnership <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm" id="partnership_id" name="partnership_id" onchange="partnershipChanged()">
                                                    <option value="">Select Partnership</option>
                                                    @foreach($partnerships as $partnership)
                                                        <option value="{{ $partnership->id }}" {{ ($partnership->id == $outlet->partnership_id)?'selected':'' }}> {{ $partnership->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_barber_seat">Barber Seat <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="number" class="form-control input-sm" id="total_barber_seat" name="total_barber_seat" value="{{ $outlet->total_barber_seat }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_reflection_seat">Massage Seat <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="number" class="form-control input-sm" id="total_reflection_seat" name="total_reflection_seat" value="{{ $outlet->total_reflection_seat }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_training_seat">Training Seat <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="number" class="form-control input-sm" id="total_training_seat" name="total_training_seat" value="{{ $outlet->total_training_seat }}" {{($outlet->partnership_id==3)?'':'readonly'}}>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-12">
                                <br>
                                <h4>Price List</h4>
                                <hr>
                            </div>

                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table id="outlet_price_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" style="text-align:center; vertical-align: middle; width: 10%;">No</th>
                                                                <th rowspan="2" style="text-align:center; vertical-align: middle;">Service</th>
                                                                <th colspan="2" style="text-align:center; vertical-align: middle;">Price</th>
                                                            </tr>
                                                            <tr>
                                                                <th style="text-align:center; vertical-align: middle;">Adult</th>
                                                                <th style="text-align:center; vertical-align: middle;">Kid</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no=1; ?>
                                                            @foreach($servicePrices as $servicePrice)
                                                                <tr>
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>{{ $servicePrice->name }} <input type="hidden" name="service_id[]" value="{{ $servicePrice->service_id }}"></td>
                                                                    <td><input type="number" class="form-control input-sm" name="adult_price[]" value="{{ $servicePrice->adult_price }}"></td>
                                                                    <td><input type="number" class="form-control input-sm" name="kid_price[]"  value="{{ $servicePrice->kid_price }}"></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12 ml-auto sweetalert">
                                                <button type="button" class="btn btn-primary m-t-15 sweet-confirm">Update</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>   
                            </div>
                            
                        </div>
                        {{ csrf_field() }}
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
var APP_URL = {!! json_encode(url('/')) !!}
</script>

<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.edit.js') }}"></script>
<script src="{{ asset('js/dashboard/outlet.js') }}"></script>
@endsection