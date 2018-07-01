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
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Daftar Partner </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Tambah Partner</a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="list" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Act</th>
                                                <th>ID Partner</th>
                                                <th>Nama Pemilik</th>
                                                <th>Alamat Pemilik</th>
                                                <th>Jumlah Outlet</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($partners as $partner)
                                            <tr>
                                                <td>
                                                    <div class="sweetalert">
                                                        <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('partner','{{ $partner->id }}')"><i class="fa fa-times"></i></button>
                                                        <a class="btn btn-default btn-xs" href="{{ url('partner/edit/'.$partner->id) }}"><i class="fa fa-pencil"></i></a>
                                                    </div>

                                                </td>
                                                <td>{{ $partner->partner_id }}</td>
                                                <td>{{ $partner->owner_name }}</td>
                                                <td>{{ $partner->owner_address }}</td>
                                                <td>{{ count($partner->outlets) }} Outlet(s)</td>
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
                        <div class="tab-pane" id="add" role="tabpanel">
                            
                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('partner/input') }}" method="post">
                                <div class="row m-t-30">
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">
                                                
                                                    <div class="form-group row">
                                                        <label class="col-lg-4" for="partner_id">Partner ID <span class="text-danger">*</span></label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control input-sm" id="partner_id" name="partner_id" value="{{ $rand['partner_id'] }}" readonly>
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
                                                            <input type="text" class="form-control input-sm" id="name" name="name" >
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
                                                            <input type="text" class="form-control input-sm" id="address" name="address" >
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
                                                            <input type="text" class="form-control input-sm" id="id_card_number" name="id_card_number">
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nomor identitas pemilik outlet sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                                <i class="fa fa-question-circle-o fa-lg"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="email">Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm" id="email" name="email" >
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Alamat email aktif pemilik outlet, akan digunakan untuk login">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="password">Password <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control input-sm" id="password" name="password">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Password minimal terdiri dari 8 karakter">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control input-sm" id="confirm_password" name="confirm_password" >
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Password minimal terdiri dari 8 karakter dan harus sama dengan password di atas">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="pks_number">Nomor PKS <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm" id="pks_number" name="pks_number" >
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
                                                        <input type="text" class="form-control input-sm" id="investation" name="investation" >
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Investasi partner yang tertera pada kontrak">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="pks_file">File PKS <span class="text-danger">*</span></label>
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
                                                    <label class="col-lg-4" for="pks_date">Tanggal PKS <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm datepicker" id="pks_date" name="pks_date" >
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
                                                        <input type="text" class="form-control input-sm datepicker" id="pks_start_date" name="pks_start_date" >
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
                                                        <input type="text" class="form-control input-sm datepicker" id="pks_end_date" name="pks_end_date" >
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Masa akhir berlakunya PKS">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
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
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <!-- End Container fluid  -->
</div>

@endsection

@section('addScript')
<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.js') }}"></script>
<script src="{{ asset('js/dashboard/partner.js') }}"></script>

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