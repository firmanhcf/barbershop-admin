@extends('layouts.master')
@section('title', 'Edit Data Kegiatan Operasional')

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
            <h4 class="text-primary">Edit Data Kegiatan Operasional</h4>
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

                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('operational/edit/'.$operational->id) }}" id="edit_form" method="post">
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="form-validation">

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="outlet_id">Outlet <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control input-sm" id="outlet_id" name="outlet_id">
                                                    <option value="">Pilih Outlet</option>
                                                    @foreach($outlets as $outlet)
                                                        <option value="{{ $outlet->id }}" {{ ($outlet->id==$operational->outlet_id)?'selected':'' }}>{{ $outlet->outlet_id }} - {{ $outlet->address }}</option>
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
                                                        <option value="{{ $item->id }}" {{ ($item->id==$operational->item_id)?'selected':'' }}>{{ $item->name }}</option>
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
                                                <input type="text" class="form-control input-sm" id="price" name="price" value="{{ $operational->price }}">
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
                                                <input type="text" class="form-control input-sm" id="qty" name="qty" value="{{ $operational->qty }}">
                                            </div>
                                            <div class="col-lg-1">
                                                <a class="btn btn-default btn-sm no-lp" data-container="body" data-toggle="popover" data-placement="right" data-content="Jumlah kegiatan dalam satu nota">
                                                    <i class="fa fa-question-circle-o fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="eviden_file">Ubah Foto Nota/Kwitansi <span class="text-danger"></span></label>
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
                                            <div class="col-lg-8 ml-auto sweetalert">
                                                <button type="button" class="btn btn-primary m-t-15 sweet-confirm">Update</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <img src="{{ asset('assets/operational/eviden/'.$operational->eviden) }}" width="100%" >
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
<script src="{{ asset('js/dashboard/asset.edit.js') }}"></script>
@endsection