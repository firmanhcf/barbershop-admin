@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>Terjadi Kesalahan</h5>

	@if($errors->first('err_msg')!=null)
		{{$errors->first('err_msg')}}
	@endif
	
</div>
@endif @if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>Success</h5>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif @if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>Error</h5>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif @if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>Warning</h5>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif @if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>Info</h5>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif
