@extends('layouts.master')
@section('title', 'Profile')

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
            <h4 class="text-primary">Profile</h4>
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
                                    Profile
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
                                                        <button type="button" class="btn btn-primary m-t-15" onclick="changePhoto()">Change Photo</button>
                                                        <button type="submit" class="btn btn-primary m-t-15" >Save Photo</button>
                                                        {{ csrf_field() }}
                                                    </div>

                                                </div>
                                            </form>
                                            
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="nik">Employee ID <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="nik" name="nik" value="{{ $employee->nik }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="name">Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="name" name="name" placeholder="Type name..." value="{{ $employee->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="province">Province <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="province" name="province" onchange="getRegency()" readonly>
                                                    <option value="">Select Province</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}" {{ ($province->id == $employee->province)?'selected':'' }}>{{ ucwords($province->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="regency">Regency <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="regency" name="regency" onchange="getDistrict()" readonly>
                                                    <option value="">Select Regency</option>
                                                    @foreach($regencies as $regency)
                                                        <option value="{{ $regency->id }}" {{ ($regency->id == $employee->regency)?'selected':'' }}>{{ ucwords($regency->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="district">District <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="district" name="district" readonly>
                                                    <option value="">Select District</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}" {{ ($district->id == $employee->district)?'selected':'' }}>{{ ucwords($district->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4" for="address">Address <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="address" name="address" placeholder="Type address..." value="{{ $employee->address }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="birthdate">Birthdate <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm datepicker no-event" id="birthdate" name="birthdate" placeholder="Choose birthdate..." value="{{ $employee->birthdate }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="religion">Religion <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="religion" name="religion" readonly>
                                                    <option value="">Select Religion</option>
                                                    @foreach(config('app.religion') as $key => $religion)
                                                        <option value="{{$key}}" {{ ($key == $employee->religion)?'selected':'' }}>{{$religion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="id_card_number">ID Card Number <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm no-event" id="id_card_number" name="id_card_number" placeholder="Type ID card number..." value="{{ $employee->id_card_number }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4" for="last_education">Last Education <span class="text-danger">*</span></label>
                                            <div class="col-lg-7">
                                                <select class="form-control input-sm no-event" id="last_education" name="last_education" readonly>
                                                    <option value="">Select Last Education</option>
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
                                    Change Password
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <form class="form-valide" enctype="multipart/form-data" action="{{ url('profile/password') }}" id="edit_form" method="post">
                                        <div class="form-validation">

                                            <div class="form-group row">
                                                <label class="col-lg-4" for="current_password">Current Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-7">
                                                    <input type="password" class="form-control input-sm" id="current_password" name="current_password" placeholder="Type your current password...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4" for="new_password">New Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-7">
                                                    <input type="password" class="form-control input-sm" id="new_password" name="new_password" placeholder="Type your new password...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4" for="confirm_password">Confirm New Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-7">
                                                    <input type="password" class="form-control input-sm" id="confirm_password" name="confirm_password" placeholder="Type your new password again...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto sweetalert">
                                                    <button type="button" class="btn btn-primary m-t-15 sweet-confirm" >Update Password</button>
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