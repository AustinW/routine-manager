@extends('master')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">
@endsection

@section('content')
{{ Form::model($athlete, array('route' => array('athletes.update', $athlete->_id))) }}

<div class="row">
	<div class="col-md-6">
		<div class="athlete-name form-group">
			{{ Form::label('first_name', 'Name:') }}<br />
			{{ Form::text('first_name', null, ['class' => 'form-control input-lg']) }}
			{{ Form::text('last_name', null, ['class' => 'form-control input-lg']) }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="athlete-team form-group">
			{{ Form::label('team', 'Team:') }}<br />
			{{ Form::text('team', null, ['class' => 'form-control']) }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-2">
		<div class="athlete-team form-group">
			{{ Form::label('birthday', 'Birthday:') }}
			<div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
				<input class="span2" size="16" type="text" value="12-02-2012" readonly="">
				<span class="add-on"><i class="fa fa-calendar"></i></span>
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				{{ Form::text('birthday', null, ['class' => 'form-control']) }}
			</div>
		</div>
	</div>
</div>

{{ Form::close() }}
@endsection

@section('js')
@parent
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
@endsection