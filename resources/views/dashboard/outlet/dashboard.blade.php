@extends('layouts.master')
@section('title', 'Daftar Partner')

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
            <h4 class="text-primary">Partner</h4>
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
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Outlet List</a> </li>
                        @if(Auth::user()->staff_position < 6)
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Add Outlet</a> </li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="list" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                @if(Auth::user()->staff_position < 6)
                                                <th>Act</th>
                                                @endif
                                                <th>Outlet ID</th>
                                                <th>Address</th>
                                                <th>Telephone</th>
                                                <th>Seat</th>
                                                <th>Patnership</th>
                                                <th>Owner</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($outlets as $outlet)
                                            <tr>
                                                @if(Auth::user()->staff_position < 6)
                                                <td>
                                                    <div class="sweetalert">
                                                        <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('outlet','{{ $outlet->id }}')"><i class="fa fa-times"></i></button>
                                                        <a class="btn btn-default btn-xs" href="{{ url('outlet/edit/'.$outlet->id) }}"><i class="fa fa-pencil"></i></a>
                                                    </div>

                                                </td>
                                                @endif
                                                <td>{{ $outlet->outlet_id }}</td>
                                                <td>{{ $outlet->address }}</td>
                                                <td>{{ $outlet->telephone_number }}</td>
                                                <td>{{ $outlet->total_barber_seat+$outlet->total_reflection_seat+$outlet->total_training_seat }}</td>
                                                <td>{{ $outlet->partnership->title }}</td>
                                                <td>{{ $outlet->owner->owner_name }}<br>({{ $outlet->owner->partner_id }})</td>
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
                        @if(Auth::user()->staff_position < 6)
                        <div class="tab-pane" id="add" role="tabpanel">
                            
                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('outlet/input') }}" method="post">
                                <div class="row m-t-30">
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="outlet_id">Outlet ID <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="outlet_id" name="outlet_id" value="{{ $rand['outlet_id'] }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="province">Province <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="province" name="province" onchange="getRegency()">
                                                            <option value="">Select Province</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ ucwords($province->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="regency">Regency <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="regency" name="regency" onchange="getDistrict()">
                                                            <option value="">Select Regency</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="district">District <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="district" name="district">
                                                            <option value="">Select District</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="address">Address <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="address" name="address">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="telephone_number">Telephone Number <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="telephone_number" name="telephone_number">
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
                                                                <option value="{{ $partner->id }}">{{ $partner->partner_id }} - {{ $partner->owner_name }}</option>
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
                                                                <option value="{{ $partnership->id }}"> {{ $partnership->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="total_barber_seat">Barber Seat <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="number" class="form-control input-sm" id="total_barber_seat" name="total_barber_seat" value="0">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="total_reflection_seat">Massage Seat <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="number" class="form-control input-sm" id="total_reflection_seat" name="total_reflection_seat" value="0">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="total_training_seat">Training Seat <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="number" class="form-control input-sm" id="total_training_seat" name="total_training_seat" value="0" readonly>
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
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-12 ml-auto">
                                                        <button type="submit" class="btn btn-primary m-t-15">Save</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>   
                                    </div>
                                    
                                </div>
                                {{ csrf_field() }}
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
</div>

@endsection

@section('addScript')
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!}
</script>

<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.js') }}"></script>
<script src="{{ asset('js/dashboard/outlet.js') }}"></script>

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