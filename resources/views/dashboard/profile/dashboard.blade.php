@extends('layouts.master')
@section('title', 'Profil')

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
            <h4 class="text-primary">Profil</h4>
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

                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="card-title">
                                    Profil
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            
                                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('profile/photo') }}" method="post">
                                                <div class="col-lg-12">
                                                    <div>
                                                        <img class="profile-photo" id="photo_preview" src="{{ empty($employee->photo)?asset('assets/profilephoto/default.png'):asset('assets/profilephoto/'.$employee->photo)}}" />
                                                        <input type="file" name="profile_photo" id="profile_photo" style="display: none;" onchange="photoChanged(this)">
                                                    </div>
                                                   
                                                    <div>
                                                        <button type="button" class="btn btn-primary m-t-15" onclick="changePhoto()">Ganti Foto</button>
                                                        <button type="submit" class="btn btn-primary m-t-15" >Simpan Foto</button>
                                                        {{ csrf_field() }}
                                                    </div>

                                                </div>
                                            </form>
                                            
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="nik">ID Karyawan <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="nik" name="nik" value="{{ $employee->nik }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="name">Nama <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="name" name="name"  value="{{ $employee->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="province">Provinsi <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="province" name="province" onchange="getRegency()" readonly>
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}" {{ ($province->id == $employee->province)?'selected':'' }}>{{ ucwords($province->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="regency">Kabupaten/Kota <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="regency" name="regency" onchange="getDistrict()" readonly>
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                    @foreach($regencies as $regency)
                                                        <option value="{{ $regency->id }}" {{ ($regency->id == $employee->regency)?'selected':'' }}>{{ ucwords($regency->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="district">Kecamatan <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="district" name="district" readonly>
                                                    <option value="">Pilih Kecamatan</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}" {{ ($district->id == $employee->district)?'selected':'' }}>{{ ucwords($district->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Alamat <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="address" name="address" value="{{ $employee->address }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="birthdate">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm datepicker no-event" id="birthdate" name="birthdate"  value="{{ $employee->birthdate }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="religion">Agama <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="religion" name="religion" readonly>
                                                    <option value="">Pilih Agama</option>
                                                    @foreach(config('app.religion') as $key => $religion)
                                                        <option value="{{$key}}" {{ ($key == $employee->religion)?'selected':'' }}>{{$religion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="id_card_number">Nomor Identitas <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="id_card_number" name="id_card_number"  value="{{ $employee->id_card_number }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="last_education">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="last_education" name="last_education" readonly>
                                                    <option value="">Pilih Pendidikan Terakhir</option>
                                                    @foreach(config('app.last_education') as $key => $education)
                                                        <option value="{{$key}}" {{ ($key == $employee->last_education)?'selected':'' }}>{{$education}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                            
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-title">
                                    Ganti Password
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('profile/password') }}" id="edit_form" method="post">
                                        <div class="form-validation">

                                            <div class="form-group row">
                                                <label class="col-lg-4" for="current_password">Password Lama <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control input-sm" id="current_password" name="current_password" >
                                                </div>
                                                <div class="col-lg-1">
                                                    <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Password yang sedang digunakan saat ini">
                                                        <i class="fa fa-question-circle-o fa-lg"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4" for="new_password">Password Baru <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control input-sm" id="new_password" name="new_password" >
                                                </div>
                                                <div class="col-lg-1">
                                                    <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Password baru minimal terdiri dari 8 karakter, harus berbeda dengan password lama">
                                                        <i class="fa fa-question-circle-o fa-lg"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4" for="confirm_password">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control input-sm" id="confirm_password" name="confirm_password" >
                                                </div>
                                                <div class="col-lg-1">
                                                    <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Password minimal terdiri dari 8 karakter dan harus sama dengan password di atas">
                                                        <i class="fa fa-question-circle-o fa-lg"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto sweetalert">
                                                    <button type="button" class="btn btn-primary m-t-15 sweet-confirm" >Ganti Password</button>
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
<script src="{{ asset('js/dashboard/profile.js') }}"></script>
@endsection