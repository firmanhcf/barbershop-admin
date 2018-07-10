@extends('layouts.master')
@section('title', 'Daftar Asset')

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
            <h4 class="text-primary">Asset</h4>
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
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Daftar Asset</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Tambah Asset</a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="list" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Act</th>
                                                <th>Provinsi</th>
                                                <th>Kota/Kabupaten</th>
                                                <th>Outlet</th>
                                                <th>Nama Aset</th>
                                                <th>Kondisi</th>
                                                <th>Qty</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach($assets as $asset)
                                            <tr>
                                                <td>
                                                    <div class="sweetalert">
                                                        <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('asset','{{ $asset->id }}')"><i class="fa fa-times"></i></button>
                                                        <a class="btn btn-default btn-xs" href="{{ url('asset/edit/'.$asset->id) }}"><i class="fa fa-pencil"></i></a>
                                                    </div>

                                                </td>
                                                <td>{{ $asset->outlet->provinces->name }}</td>
                                                <td>{{ $asset->outlet->regencies->name }}</td>
                                                <td>{{ $asset->outlet->outlet_id }} <br> {{ $asset->outlet->address }}</td>
                                                <td>{{ $asset->item->name }}</td>
                                                <td>{{ $assetStatus[$asset->status] }}</td>
                                                <td>{{ $asset->qty }}</td>
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
                            
                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('asset/input') }}" method="post">
                                <div class="row m-t-30">
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="outlet_id">Outlet <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control input-sm" id="outlet_id" name="outlet_id">
                                                            <option value="">Pilih Outlet</option>
                                                            @foreach($outlets as $outlet)
                                                                <option value="{{ $outlet->id }}">{{ $outlet->outlet_id }} - {{ $outlet->address }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Outlet sesuai lokasi aset berada">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="item_id">Nama Aset <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control input-sm" id="item_id" name="item_id">
                                                            <option value="">Pilih Aset</option>
                                                            @foreach($items as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nama aset yang akan direcord ke dalam sistem">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="qty">Qty <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm" id="qty" name="qty">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jumlah asset, pisahkan asset yang kondisinya masih baik dan sudah rusak">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="price">Price <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control input-sm" id="price" name="price">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Harga satuan aset">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="age">Umur Ekonomis <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control input-sm" id="age" name="age">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Umur Ekonomis Aset, satuan bulan">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="arrival">Tgl. Diterima<span class="text-danger"></span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm datepicker" id="arrival" name="arrival" >
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Tanggal asset diterima dan masuk outlet">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="status">Kondisi Aset <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control input-sm" id="status" name="status">
                                                            <option value="">Pilih Kondisi</option>
                                                            @foreach($assetStatus as $key => $status)
                                                                <option value="{{ $key }}">{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Status aset masih dalam kondisi baik atau sudah rusak">
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
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!}
</script>

<script src="{{ asset('js/lib/form-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lib/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.partner.js') }}"></script>
<script src="{{ asset('js/dashboard/asset.js') }}"></script>

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