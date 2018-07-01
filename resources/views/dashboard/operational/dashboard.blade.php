@extends('layouts.master')
@section('title', 'Daftar Kegiatan Operasional Outlet')

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
            <h4 class="text-primary">Kegiatan Operasional Outlet</h4>
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
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Daftar Kegiatan Opr.</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Tambah Kegiatan Opr.</a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="list" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>

                                                <th>Act</th>
                                                <th>Tanggal</th>
                                                <th>Provinsi</th>
                                                <th>Kota/Kabupaten</th>
                                                <th>Outlet</th>
                                                <th>Kegiatan</th>
                                                <th>Harga (Rp)</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach($operationals as $operational)
                                            <tr>
                                                <td>
                                                    <div class="sweetalert">
                                                        <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('operational','{{ $operational->id }}')"><i class="fa fa-times"></i></button>
                                                        <a class="btn btn-default btn-xs" href="{{ url('operational/edit/'.$operational->id) }}"><i class="fa fa-pencil"></i></a>
                                                    </div>

                                                </td>
                                                <td>
                                                    {{ date_format($operational -> created_at,"d-M-y") }}
                                                    <br>
                                                    {{ date_format($operational -> created_at,"H:i A") }}
                                                </td>
                                                <td>{{ $operational->outlet->provinces->name }}</td>
                                                <td>{{ $operational->outlet->regencies->name }}</td>
                                                <td>{{ $operational->outlet->outlet_id }} <br> {{ $operational->outlet->address }}</td>
                                                <td>{{ $operational->item->name }}</td>
                                                <td>{{ number_format($operational->price,2,",",".") }}</td>
                                                <td>{{ $operational->qty }}</td>
                                                <td>{{ number_format(($operational->price * $operational->qty),2,",",".") }}</td>
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
                            
                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('operational/input') }}" method="post">
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
                                                    <label class="col-lg-4" for="item_id">Nama Kegiatan <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control input-sm" id="item_id" name="item_id">
                                                            <option value="">Pilih Kegiatan</option>
                                                            @foreach($items as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Nama kegiatan yang akan direcord ke dalam sistem">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="price">Harga Satuan<span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control input-sm" id="price" name="price">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Harga satuan kegiatan">
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
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jumlah kegiatan">
                                                            <i class="fa fa-question-circle-o fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="eviden_file">Foto Nota/Kwitansi <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input name="eviden_file" class="form-control input-sm" id="eviden_file" type="file" />
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Foto nota/kwitansi kegiatan">
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
<script src="{{ asset('js/dashboard/operational.js') }}"></script>

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