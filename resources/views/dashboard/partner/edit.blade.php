@extends('layouts.master')
@section('title', 'Edit Data Partner')

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
            <h4 class="text-primary">Edit Data Partner</h4>
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
                                            <label class="col-lg-4" for="partner_id">ID Partner <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="partner_id" name="partner_id" value="{{ $partner->partner_id }}" readonly>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="ID Partner bersifat unik, dibuat oleh sistem">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="name">Nama Pemilik <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="name" name="name" value="{{ $partner->owner_name }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nama pemilik outlet sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Alamat Pemilik <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="address" name="address" value="{{ $partner->owner_address }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Alamat pemilik outlet sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="id_card_number">No. Identitas <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="id_card_number" name="id_card_number" value="{{ $partner->owner_id_card_number }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nomor identitas pemilik outlet sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-11">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_number">Nomor PKS <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="pks_number" name="pks_number" value="{{ $pks->pks_number }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nomor PKS yang tertera pada kontrak">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="investation">Investasi <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="investation" name="investation" value="{{ $pks->investation }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Investasi partner yang tertera pada kontrak">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_date">Tanggal PKS <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_date" name="pks_date" value="{{ $pks->pks_date }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Tanggal pembuatan PKS">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_start_date">Berlaku dari <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_start_date" name="pks_start_date" placeholder="Choose pks start date..." value="{{ $pks->pks_start_date }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Tanggal mulai berlakunya PKS">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_end_date">Berlaku hingga <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_end_date" name="pks_end_date" placeholder="Choose pks end date..." value="{{ $pks->pks_end_date }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Masa akhir berlakunya PKS">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_file">Ganti File PKS <span class="text-danger"></span></label>
                                            <div class="col-lg-6">
                                                <input name="pks_file" class="form-control input-sm" id="pks_file" type="file" />
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Upload scan file PKS berupa PDF">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
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