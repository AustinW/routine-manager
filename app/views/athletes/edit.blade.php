@extends('master')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('assets/datepicker/css/datepicker3.css') }}">
@endsection

@section('content')
{{ Form::model($athlete, ['route' => ['athletes.update', $athlete->_id], 'method' => 'PUT']) }}

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
	<div class="col-md-4">
		<label>Gender:</label><br />
		<div class="btn-group athlete-gender" data-toggle="buttons">
			<label class="btn btn-baby-blue" id="athlete-gender-male">
				{{ Form::radio('gender', 'male') }} <i class="fa fa-2x fa-male"></i>
			</label>
			<label class="btn btn-pink" id="athlete-gender-female">
				{{ Form::radio('gender', 'female') }} <i class="fa fa-2x fa-female"></i>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-2">
		<div class="athlete-birthday form-group">
			{{ Form::label('birthday', 'Birthday:') }}
			<div class="input-group input-append date">
			  {{ Form::text('birthday', null, ['class' => 'form-control']) }}
			  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
			
		</div>
	</div>
</div>

<div class="row">
	<div class="container">

	    <div class="row">
	    	<div class="col-md-12 col-sm-12">
	    		<h3>Routines:</h3>
	    	</div>
	    </div>

	    <div class="row">
	        <!-- Trampoline -->
	        <div class="col-xs-12 col-sm-3 col-md-3">
	            <div class="panel panel-info">
	                <div class="panel-heading">
	                    <h3 class="panel-title">Trampoline</h3>
	                </div>
	                <div class="panel-body">
	                    <div class="the-price">
	                        {{ Form::select('trampoline_level', Athlete::$levels, null, ['class' => 'form-control input-lg']) }}
	                    </div>
	                    <table class="table">
	                        <tr><td>Compulsory:          {{ Form::select('tra_prelim_compulsory', $trampolineRoutines, ($athlete->traPrelimCompulsory) ? $athlete->traPrelimCompulsory->_id : null) }}</td></tr>
	                        <tr><td>Prelim Optional:     {{ Form::select('tra_prelim_optional', $trampolineRoutines, ($athlete->traPrelimOptional) ? $athlete->traPrelimOptional->_id : null) }}</td></tr>
	                        <tr><td>Semi-final Optional: {{ Form::select('tra_semi_final_optional', $trampolineRoutines, ($athlete->traSemiFinalOptional) ? $athlete->traSemiFinalOptional->_id : null) }}</td></tr>
	                        <tr><td>Final Optional:      {{ Form::select('tra_final_optional', $trampolineRoutines, ($athlete->traFinalOptional) ? $athlete->traFinalOptional->_id : null) }}</td></tr>
	                    </table>
	                </div>
	            </div>
	        </div>

	        <!-- Synchro -->
	        <div class="col-xs-12 col-sm-3 col-md-3">
	            <div class="panel panel-warning">
	                <div class="panel-heading">
	                    <h3 class="panel-title">Synchro</h3>
	                </div>
	                <div class="panel-body">
	                    <div class="the-price">
	                        {{ Form::select('synchro_level', Athlete::$levels, null, ['class' => 'form-control input-lg']) }}
	                    </div>
	                    <table class="table">
	                        <tr><td>Partner:         {{ Form::select('synchro_partner', $synchroPartners, ($athlete->synchroPartner) ? $athlete->synchroPartner->_id : null) }}</td></tr>
	                        <tr><td>Compulsory:      {{ Form::select('sync_prelim_compulsory', $trampolineRoutines, ($athlete->syncPrelimCompulsory) ? $athlete->syncPrelimCompulsory->_id : null) }}</td></tr>
	                        <tr><td>Prelim Optional: {{ Form::select('sync_prelim_optional', $trampolineRoutines, ($athlete->syncPrelimOptional) ? $athlete->syncPrelimOptional->_id : null) }}</td></tr>
	                        <tr><td>Final Optional:  {{ Form::select('sync_final_optional', $trampolineRoutines, ($athlete->syncFinalOptional) ? $athlete->syncFinalOptional->_id : null) }}</td></tr>
	                    </table>
	                </div>
	            </div>
	        </div>

	        <!-- Double-Mini -->
	        <div class="col-xs-12 col-sm-3 col-md-3">
	            <div class="panel panel-success">
	                <div class="panel-heading">
	                    <h3 class="panel-title">Double-Mini</h3>
	                </div>
	                <div class="panel-body">
	                    <div class="the-price">
	                        {{ Form::select('doublemini_level', Athlete::$levels, null, ['class' => 'form-control input-lg']) }}
	                    </div>
	                    <table class="table">
	                        <tr><td>Pass 1: {{{ $athlete->dmtPass1->name or 'None' }}}</td></tr>
	                        <tr><td>Pass 2: {{{ $athlete->dmtPass2->name or 'None' }}}</td></tr>
	                        <tr><td>Pass 3: {{{ $athlete->dmtPass3->name or 'None' }}}</td></tr>
	                        <tr><td>Pass 4: {{{ $athlete->dmtPass4->name or 'None' }}}</td></tr>
	                    </table>
	                </div>
	            </div>
	        </div>

	        <!-- Tumbling -->
	        <div class="col-xs-12 col-sm-3 col-md-3">
	            <div class="panel panel-danger">
	                <div class="panel-heading">
	                    <h3 class="panel-title">Tumbling</h3>
	                </div>
	                <div class="panel-body">
	                    <div class="the-price">
	                        {{ Form::select('tumbling_level', Athlete::$levels, null, ['class' => 'form-control input-lg']) }}
	                    </div>
	                    <table class="table">
	                        <tr><td>Pass 1: {{{ $athlete->tumblingPass1->name or 'None' }}}</td></tr>
	                        <tr><td>Pass 2: {{{ $athlete->tumblingPass2->name or 'None' }}}</td></tr>
	                        <tr><td>Pass 3: {{{ $athlete->tumblingPass3->name or 'None' }}}</td></tr>
	                        <tr><td>Pass 4: {{{ $athlete->tumblingPass4->name or 'None' }}}</td></tr>
	                    </table>
	                </div>
	            </div>
	        </div>

	    </div>

	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="well">
			{{ Form::submit('Submit', ['class' => 'btn btn-lg btn-primary']) }}
			{{ Form::button('Cancel', ['class' => 'btn btn-lg btn-default']) }}
		</div>
	</div>
</div>

{{ Form::close() }}
@endsection

@section('js')
@parent
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.js') }}"></script>
@endsection