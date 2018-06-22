@extends('layouts.master')
@section('title', 'Daftar Karyawan')

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
            <h4 class="text-primary">Employee</h4>
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
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#list" role="tab"><i class="fa fa-table"></i> Employee List</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#list-caps" role="tab"><i class="fa fa-table"></i> Capster List</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add" role="tab"><i class="fa fa-plus-square"></i> Add Employee/Capster</a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="list" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Act</th>
                                                <th>Emp ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Position</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach($employees as $employee)
                                            <tr>
                                                <td>
                                                    <div class="sweetalert">
                                                        <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('employee','{{ $employee->id }}')"><i class="fa fa-times"></i></button>
                                                        <a class="btn btn-default btn-xs" href="{{ url('employee/edit/'.$employee->id) }}"><i class="fa fa-pencil"></i></a>
                                                    </div>

                                                </td>
                                                <td>{{ $employee->nik }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $pos[$employee->staff_position] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="list-caps" role="tabpanel">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Act</th>
                                                <th>Emp ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Outlet</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($capsters as $capster)
                                            <tr>
                                                <td>
                                                    <div class="sweetalert">
                                                        <button type="button" class="btn btn-default btn-xs" onclick="showSweetAlert('employee','{{ $capster->id }}')"><i class="fa fa-times"></i></button>
                                                        <a class="btn btn-default btn-xs" href="{{ url('employee/edit/'.$capster->id) }}"><i class="fa fa-pencil"></i></a>
                                                    </div>

                                                </td>
                                                <td>{{ $capster->nik }}</td>
                                                <td>{{ $capster->name }}</td>
                                                <td>{{ $capster->address }}</td>
                                                <td>{{ $capster->outlet->outlet_id }}<br>{{ $capster->outlet->address }}</td>
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
                            
                            <form class="form-valide" enctype="multipart/form-data" action="{{ url('employee/input') }}" method="post">
                                <div class="row m-t-30">
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="nik">Employee ID <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="nik" name="nik" value="{{ $rand['emp_id'] }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="name">Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Type name...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="province">Province <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="province" name="province" onchange="getRegency()">
                                                            <option value="">Select Province</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ ucwords($province->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="regency">Regency <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="regency" name="regency" onchange="getDistrict()">
                                                            <option value="">Select Regency</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="district">District <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="district" name="district">
                                                            <option value="">Select District</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="address">Address <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="address" name="address" placeholder="Type address...">
                                                    </div>
                                                </div>

                                                    
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">

                                                 <div class="form-group row">
                                                    <label class="col-lg-4" for="birthdate">Birthdate <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm datepicker" id="birthdate" name="birthdate" placeholder="Choose birthdate...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="religion">Religion <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="religion" name="religion">
                                                            <option value="">Select Religion</option>
                                                            @foreach(config('app.religion') as $key => $religion)
                                                                <option value="{{$key}}">{{$religion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="id_card_number">ID Card Number <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="id_card_number" name="id_card_number" placeholder="Type ID card number...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="id_card_files">Scan ID Card <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input name="id_card_files" class="form-control input-sm" id="id_card_files" type="file" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="last_education">Last Education <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="last_education" name="last_education">
                                                            <option value="">Select Last Education</option>
                                                            @foreach(config('app.last_education') as $key => $education)
                                                                <option value="{{$key}}">{{$education}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="last_education_certificate">Last Education Certificate <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input name="last_education_certificate" class="form-control input-sm" id="last_education_certificate" type="file" />
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
                                                    <label class="col-lg-4" for="email">Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="email" name="email" placeholder="Type email...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="password">Password <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="password" class="form-control input-sm" id="password" name="password" placeholder="Type password...">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="password" class="form-control input-sm" id="confirm_password" name="confirm_password" placeholder="Type password again...">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <div class="form-validation">

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="staff_status">Employee Status <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="staff_status" name="staff_status">
                                                            <option value="" >Select Employee Status</option>
                                                            @foreach(config('app.employee_status') as $key => $status)
                                                                <option value="{{$key}}">{{$status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="staff_position">Employee Position <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="staff_position" name="staff_position" onchange="setOutlet()">
                                                            <option value="">Select Employee Position</option>
                                                            @foreach(config('app.employee_position') as $key => $position)
                                                                <option value="{{$key}}">{{$position}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="outlet_id">Outlet <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <select class="form-control input-sm" id="outlet_id" name="outlet_id" readonly style="pointer-events: none;">
                                                            <option value="">Select Outlet</option>
                                                            <option value="0" style="display:none;">Management</option>
                                                            @foreach($outlets as $outlet)
                                                                <option value="{{ $outlet->id }}">{{ $outlet->outlet_id }} - {{ $outlet->address }}</option>
                                                            @endforeach
                                                        </select>
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
                                                    <label class="col-lg-4" for="pks_number">PKS Number <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="pks_number" name="pks_number" placeholder="Type pks number...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="salary">Salary <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm" id="salary" name="salary" placeholder="Type monthly salary...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="pks_file">PKS File <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input name="pks_file" class="form-control input-sm" id="pks_file" type="file" />
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
                                                    <label class="col-lg-4" for="pks_date">PKS Date <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm datepicker" id="pks_date" name="pks_date" placeholder="Choose pks date...">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="pks_start_date">PKS Start Date <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm datepicker" id="pks_start_date" name="pks_start_date" placeholder="Choose pks start date...">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4" for="pks_end_date">PKS End Date <span class="text-danger">*</span></label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm datepicker" id="pks_end_date" name="pks_end_date" placeholder="Choose pks end date...">
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
<script src="{{ asset('js/dashboard/employee.js') }}"></script>

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