@extends('layouts.master')
@section('title', 'Daftar Outlet')

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
            <h4 class="text-primary">Outlet</h4>
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
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Daftar Outlet</a> </li>
                        @if(Auth::user()->staff_position < 6)
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Tambah Outlet</a> </li>
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
                                                <th>ID Outlet</th>
                                                <th>Nama Outlet</th>
                                                <th>Alamat</th>
                                                <th>No. Telp.</th>
                                                <th>Jumlah Kursi</th>
                                                <th>Kemitraan</th>
                                                <th>Pemilik</th>
                                                
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
                                                <td>{{ $outlet->name }}</td>
                                                <td>{{ $outlet->address }}, {{ $outlet->districts->name }} <br> {{ $outlet->regencies->name }} {{ $outlet->provinces->name }}</td>
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
                                                    <label class="col-lg-4" for="outlet_id">ID Outlet <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm" id="outlet_id" name="outlet_id" value="{{ $rand['outlet_id'] }}" readonly>
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
                                                        <input type="text" class="form-control input-sm" id="name" name="name">
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
                                                                <option value="{{ $province->id }}">{{ ucwords($province->name) }}</option>
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
                                                        <input type="text" class="form-control input-sm" id="address" name="address">
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
                                                        <input type="text" class="form-control input-sm" id="telephone_number" name="telephone_number">
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
                                                                <option value="{{ $partner->id }}">{{ $partner->partner_id }} - {{ $partner->owner_name }}</option>
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
                                                                <option value="{{ $partnership->id }}"> {{ $partnership->title }}</option>
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
                                                        <input type="number" class="form-control input-sm" id="total_barber_seat" name="total_barber_seat" value="0">
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
                                                        <input type="number" class="form-control input-sm" id="total_reflection_seat" name="total_reflection_seat" value="0">
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
                                                        <input type="number" class="form-control input-sm" id="total_training_seat" name="total_training_seat" value="0" readonly>
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