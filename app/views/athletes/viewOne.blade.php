@extends('athletes/view')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>{{{ $athlete->name() }}}</h1>
        <p class="lead">{{{ $athlete['team'] }}}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-2 col-sm-2 text-center">
        <i class="fa fa-2x fa-calendar"></i><br /> Birthday: {{ $athlete->birthday }}
    </div>

    <div class="col-md-2 col-sm-2 text-center">
        <i class="fa fa-2x fa-{{ $athlete->gender }}"></i><br /> Gender: {{ ucwords($athlete->gender) }}
    </div>
</div>

<div class="row" style="margin-top:25px">

    {{--@if ($athlete->trampoline_level)
    <div class="col-md-3 col-sm-3 athlete-event">
        <h4>Trampoline</h4>
        Level: {{ Athlete::$levels[$athlete->trampoline_level] }}
    </div>
    @endif

    @if ($athlete->synchro_level)
    <div class="col-md-3 col-sm-3 athlete-event">
        <h4>Synchro</h4>
        Level: {{ Athlete::$levels[$athlete->synchro_level] }}
    </div>
    @endif

    @if ($athlete->doublemini_level)
    <div class="col-md-3 col-sm-3 athlete-event">
        <h4>Double-Mini</h4>
        Level: {{ Athlete::$levels[$athlete->doublemini_level] }}
    </div>
    @endif

    @if ($athlete->tumbling_level)
    <div class="col-md-3 col-sm-3 athlete-event">
        <h4>Tumbling</h4>
        Level: {{ Athlete::$levels[$athlete->tumbling_level] }}
    </div>
    @endif--}}

    <div class="container">
        <div class="row">

            <!-- Trampoline -->
            @if ($athlete->trampoline_level)
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trampoline</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p class="lead">{{ Athlete::$levels[$athlete->trampoline_level] }}</p>
                        </div>
                        <table class="table">
                            <tr><td>Compulsory:          {{{ $athlete->traPrelimCompulsory->name or 'None' }}}</td></tr>
                            <tr><td>Prelim Optional:     {{{ $athlete->traPrelimOptional->name or 'None' }}}</td></tr>
                            <tr><td>Semi-final Optional: {{{ $athlete->traSemiFinalOptional->name or 'None' }}}</td></tr>
                            <tr><td>Final Optional:      {{{ $athlete->traFinalOptional->name or 'None' }}}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Synchro -->
            @if ($athlete->synchro_level)
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Synchro</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p class="lead">{{ Athlete::$levels[$athlete->synchro_level] }}</p>
                        </div>
                        <table class="table">
                            <tr><td>Partner: </td></tr>
                            <tr><td>Compulsory:          {{{ $athlete->syncPrelimCompulsory->name or 'None' }}}</td></tr>
                            <tr><td>Prelim Optional:     {{{ $athlete->syncPrelimOptional->name or 'None' }}}</td></tr>
                            <tr><td>Semi-final Optional: {{{ $athlete->syncSemiFinalOptional->name or 'None' }}}</td></tr>
                            <tr><td>Final Optional:      {{{ $athlete->syncFinalOptional->name or 'None' }}}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Double-Mini -->
            @if ($athlete->doublemini_level)
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Double-Mini</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p class="lead">{{ Athlete::$levels[$athlete->doublemini_level] }}</p>
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
            @endif

            <!-- Tumbling -->
            @if ($athlete->tumbling_level)
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tumbling</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p class="lead">{{ Athlete::$levels[$athlete->tumbling_level] }}</p>
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
            @endif

        </div>

    </div>

    @if (Auth::user()->_id == $athlete->user_id)
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-info btn-large" href="{{ URL::action('AthletesController@edit', $athlete->_id) }}">Edit</a>
            <a class="btn btn-danger btn-large" href="{{ URL::action('AthletesController@destroy', $athlete->_id) }}" onclick="return confirm('{{ trans('athlete.confirm_delete') }}')">Delete</a>
        </div>
    </div>

    @endif


</div>

{{var_dump($athlete)}}

@endsection