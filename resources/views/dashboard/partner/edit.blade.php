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
            <h4 class="text-primary">Edit Outlet</h4>
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

                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('partner/edit/'.$partner->id) }}" id="edit_form" method="post">
                        <div class="row m-t-30">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="partner_id">Partner ID <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="partner_id" name="partner_id" value="{{ $partner->partner_id }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="name">Owner Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Type owner name..." value="{{ $partner->owner_name }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Owner Address <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="address" name="address" placeholder="Type owner address..." value="{{ $partner->owner_address }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="id_card_number">ID Card Number <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="id_card_number" name="id_card_number" placeholder="Type owner ID card number..." value="{{ $partner->owner_id_card_number }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-11">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_number">PKS Number <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="pks_number" name="pks_number" placeholder="Type pks number..." value="{{ $pks->pks_number }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="investation">Investation <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm" id="investation" name="investation" placeholder="Type venture capital of owner..." value="{{ $pks->investation }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_date">PKS Date <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_date" name="pks_date" placeholder="Choose pks date..." value="{{ $pks->pks_date }}">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_start_date">PKS Start Date <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_start_date" name="pks_start_date" placeholder="Choose pks start date..." value="{{ $pks->pks_start_date }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_end_date">PKS End Date <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_end_date" name="pks_end_date" placeholder="Choose pks end date..." value="{{ $pks->pks_end_date }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_file">Change PKS File <span class="text-danger"></span></label>
                                            <div class="col-lg-7">
                                                <input name="pks_file" class="form-control input-sm" id="pks_file" type="file" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto sweetalert">
                                                <button type="button" class="btn btn-primary m-t-15 sweet-confirm" >Update</button>
                                            </div>
                                        </div>

                                        
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">


                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <embed src="{{ asset('assets/pks/partner/'.$pks->pks_file) }}" width="100%" height="460" type="application/pdf">
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


<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.edit.js') }}"></script>
<script src="{{ asset('js/dashboard/partner.edit.js') }}"></script>

@endsection