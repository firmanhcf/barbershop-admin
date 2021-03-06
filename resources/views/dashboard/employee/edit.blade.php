@extends('layouts.master')
@section('title', 'Edit Data Karyawan')

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
            <h4 class="text-primary">Edit Data Karyawan</h4>
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

                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('employee/edit/'.$employee->id) }}" id="edit_form" method="post">
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="nik">ID Karyawan<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="nik" name="nik" value="{{ $employee->nik }}" readonly>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="ID Karyawan bersifat unik, dibuat oleh sistem">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="name">Nama <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="name" name="name" value="{{ $employee->name }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nama Karyawan berdasarkan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="province">Provinsi <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="province" name="province" onchange="getRegency()">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}" {{ ($province->id == $employee->province)?'selected':'' }}>{{ ucwords($province->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Provinsi sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="regency">Kabupaten/Kota <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="regency" name="regency" onchange="getDistrict()">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                    @foreach($regencies as $regency)
                                                        <option value="{{ $regency->id }}" {{ ($regency->id == $employee->regency)?'selected':'' }}>{{ ucwords($regency->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Kabupaten/Kota sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="district">Kecamatan <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="district" name="district">
                                                    <option value="">Pilih Kecamatan</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}" {{ ($district->id == $employee->district)?'selected':'' }}>{{ ucwords($district->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Kecamatan sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Alamat <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="address" name="address"value="{{ $employee->address }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Alamat sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="birthdate">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm datepicker" id="birthdate" name="birthdate" value="{{ $employee->birthdate }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Tanggal lahir sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="religion">Agama <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="religion" name="religion">
                                                    <option value="">Pilih Agama</option>
                                                    @foreach(config('app.religion') as $key => $religion)
                                                        <option value="{{$key}}" {{ ($key == $employee->religion)?'selected':'' }}>{{$religion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Agama sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="id_card_number">No Identitas <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="id_card_number" name="id_card_number" value="{{ $employee->id_card_number }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="No Identitas sesuai dengan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="id_card_files">Ganti Scan Kartu Identitas <span class="text-danger"></span></label>
                                            <div class="col-lg-6">
                                                <input name="id_card_files" class="form-control input-sm" id="id_card_files" type="file" />
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="upload gambar scan kartu identitas (KTP/SIM/Paspor)">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="last_education">Pend. Terakhir <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="last_education" name="last_education">
                                                    <option value="">Pilih Pendidikan Terakhir</option>
                                                    @foreach(config('app.last_education') as $key => $education)
                                                        <option value="{{$key}}" {{ ($key == $employee->last_education)?'selected':'' }}>{{$education}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Pilih jenjang pendidikan terakhir yang pernah dijalani">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="last_education_certificate">Ganti Ijazah Terakhir <span class="text-danger"></span></label>
                                            <div class="col-lg-6">
                                                <input name="last_education_certificate" class="form-control input-sm" id="last_education_certificate" type="file" />
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="upload file PDF hasil scan Ijazah pendidikan terakhir">
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
                                            <div class="col-lg-12">
                                                <img src="{{ asset('assets/idcard/'.$employee->id_card_files) }}" height="200" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <embed src="{{ asset('assets/certificate/'.$employee->last_education_certificate) }}" width="100%" height="300" type="application/pdf">
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
                                            <label class="col-lg-4" for="staff_status">Status Karyawan <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="staff_status" name="staff_status">
                                                    <option value="" >Pilih Status Karyawan</option>
                                                    @foreach(config('app.employee_status') as $key => $status)
                                                        <option value="{{$key}}" {{ ($key == $employee->staff_status)?'selected':'' }}>{{$status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="staff_position">Posisi Karyawan <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="staff_position" name="staff_position" onchange="setOutlet()">
                                                    <option value="">Pilih Posisi Karyawan</option>
                                                    @foreach(config('app.employee_position') as $key => $position)
                                                        <option value="{{$key}}" {{ ($key == $employee->staff_position)?'selected':'' }}>{{$position}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="outlet_id">Outlet <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="outlet_id" name="outlet_id" {{ ( $employee->outlet_id == '0')?'readonly style="pointer-events: none;"':'' }}>
                                                    <option value="">Pilih Outlet</option>
                                                    <option value="0" style="display:none;" {{ ( $employee->outlet_id == '0')?'selected':'' }}>Management</option>
                                                    @foreach($outlets as $outlet)
                                                        <option value="{{ $outlet->id }}" {{ ($outlet->id == $employee->outlet_id)?'selected':'' }}>{{ $outlet->outlet_id }} - {{ $outlet->address }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Outlet hanya tersedia untuk supervisor dan kapster">
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
                                                <input type="text" class="form-control input-sm" id="pks_number" name="pks_number" placeholder="Type pks number..." value="{{ $pks->pks_number }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="No PKS yang tertera pada kontrak">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="salary">Upah <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="salary" name="salary" placeholder="Type venture capital of owner..." value="{{ $employee->salary }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nominal upah karyawan bulanan">
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
                                            <label class="col-lg-4" for="pks_start_date">Berlaku pada <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_start_date" name="pks_start_date" value="{{ $pks->pks_start_date }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Tanggal mulai berlakunya PKS">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_end_date">Berakhir pada <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm datepicker" id="pks_end_date" name="pks_end_date" value="{{ $pks->pks_end_date }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Masa akhir berlakunya PKS">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="pks_file">Ubah Scan PKS <span class="text-danger"></span></label>
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
                                                <embed src="{{ asset('assets/pks/employee/'.$pks->pks_file) }}" width="100%" height="260" type="application/pdf">
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
<script src="{{ asset('js/dashboard/employee.edit.js') }}"></script>
@endsection