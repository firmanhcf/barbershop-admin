@extends('layouts.master')
@section('title', 'Edit Data Outlet')

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
            <h4 class="text-primary">Edit Data Outlet</h4>
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
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="outlet_id">ID Outlet <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="outlet_id" name="outlet_id" value="{{ $outlet->outlet_id }}" readonly>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="ID Outlet bersifat unik, dibuat oleh sistem">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="name">Nama Outlet <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="name" value="{{ $outlet->name }}" name="name">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nama outlet barber shop">
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
                                                        <option value="{{ $province->id }}" {{ ($province->id == $outlet->province)?'selected':'' }}>{{ ucwords($province->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Provinsi lokasi outlet berada">
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
                                                        <option value="{{ $regency->id }}" {{ ($regency->id == $outlet->regency)?'selected':'' }}>{{ ucwords($regency->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Kabupaten/Kota lokasi outlet berada">
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
                                                        <option value="{{ $district->id }}" {{ ($district->id == $outlet->district)?'selected':'' }}>{{ ucwords($district->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Kecamatan lokasi outlet berada">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Alamat <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="address" name="address" value="{{ $outlet->address }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Alamat lokasi outlet berada">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="telephone_number">No. Telepon <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control input-sm" id="telephone_number" name="telephone_number" value="{{ $outlet->telephone_number }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nomor line telepon outlet">
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
                                            <label class="col-lg-4" for="partner_id">Pemilik/Investor <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="partner_id" name="partner_id">
                                                    <option value="">Pilih Pemilik/Investor</option>
                                                    @foreach($partners as $partner)
                                                        <option value="{{ $partner->id }}" {{ ($partner->id == $outlet->partner_id)?'selected':'' }}>{{ $partner->partner_id }} - {{ $partner->owner_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Pemilik/Investor outlet">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="partnership_id">Kemitraan <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="partnership_id" name="partnership_id" onchange="partnershipChanged()">
                                                    <option value="">Pilih Kemitraan</option>
                                                    @foreach($partnerships as $partnership)
                                                        <option value="{{ $partnership->id }}" {{ ($partnership->id == $outlet->partnership_id)?'selected':'' }}> {{ $partnership->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jenis kemitraan outlet sesuai dengan yang tercantum pada PKS">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_barber_seat">Kursi Potong <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control input-sm" id="total_barber_seat" name="total_barber_seat" value="{{ $outlet->total_barber_seat }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jumlah kursi outlet yang digunakan untuk potong rambut">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_reflection_seat">Kursi Pijat <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control input-sm" id="total_reflection_seat" name="total_reflection_seat" value="{{ $outlet->total_reflection_seat }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jumlah kursi outlet yang digunakan untuk pijat/refleksi">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="total_training_seat">Kursi Pelatihan <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control input-sm" id="total_training_seat" name="total_training_seat" value="{{ $outlet->total_training_seat }}" {{($outlet->partnership_id==3)?'':'readonly'}}>
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jumlah kursi outlet yang digunakan untuk pelatihan, hanya ada di kemitraan platinum">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
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
                                                                <th rowspan="2" style="text-align:center; vertical-align: middle;">Layanan</th>
                                                                <th colspan="2" style="text-align:center; vertical-align: middle;">Harga (Rp)</th>
                                                            </tr>
                                                            <tr>
                                                                <th style="text-align:center; vertical-align: middle;">Dewasa</th>
                                                                <th style="text-align:center; vertical-align: middle;">Anak</th>
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