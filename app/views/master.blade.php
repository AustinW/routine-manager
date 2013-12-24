<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Routine Manager</title>
  @section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @show
</head>
<body>

  <div class="container">
    <div class="header">

      <!-- Static navbar -->
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="/" class="navbar-brand">Routine Manager</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Athletes <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>{{ link_to('athletes/create', 'New') }}</li>
                <li>{{ link_to('athletes', 'View') }}</li>
                <li><a href="#">Search</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Routines <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">New</a></li>
                <li><a href="#">View</a></li>
                <li><a href="#">Search</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Compcards <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">New</a></li>
                <li><a href="#">View</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
              <ul class="dropdown-menu">
                @if (Auth::check())
                <li><a href="#"><i class="icon-user"></i> <strong>{{ Auth::user()->name() }}</strong></a></li>
                @else
                <li>{{ link_to('account/login', 'Login') }}</li>
                <li>{{ link_to('account/Register', 'Register') }}</li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      
      @if (Session::has('alert'))
      <div class="alert {{ Session::get('alert.class') }}">
        <strong>{{ Session::get('alert.title') }}</strong>
        @if (is_array(Session::get('alert.message')))
          <ul>
          @foreach (Session::get('alert.message') as $message)
            <li>{{ $message }}</li>
          @endforeach
          </ul>
        @else
        {{ Session::get('alert.message') }}
        @endif
      </div>
      @endif

      @yield('content')

    </div>

    <div class="footer">
      <p class="pull-left">&copy; 2013 Austin White</p>
      <p class="pull-right">
        <a href="http://www.facebook.com/" target="_blank"><i class="icon-facebook"></i></a>
        <a href="http://www.twitter.com/" target="_blank"><i class="icon-twitter"></i></a>
        <a href="http://plus.google.com/" target="_blank"><i class="icon-google-plus"></i></a>
      </p>
    </div>

  </div>

  {{--<script type="text/x-handlebars" data-template-name="athletes/index">
    <table class="table table-striped table-bordered table-hover table-responsive">
      <thead>
        <tr>
          <th>Name</th>
          <th>Birthdate</th>
          <th>TRA</th>
          <th>TRS</th>
          <th>DMT</th>
          <th>TUM</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        {{#each model}}
          <tr>
            <td>{{#link-to 'athletes.view' _id }}{{ first_name }} {{ last_name }}{{/link-to}}</td>
            <td>{{ birthday }}</td>
            <td>{{ trampoline_level }}</td>
            <td>{{ trampoline_level }}</td>
            <td>{{ doublemini_level }}</td>
            <td>{{ tumbling_level }}</td>
            <td>Options...</td>
          </tr>
        {{/each}}
      </tbody>
    </table>
  </script>

  <script type="text/x-handlebars" data-template-name="athletes/view">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-sm-6 col-md-2">
                      <i class="glyphicon glyphicon-user" style="font-size:160px"></i>
                    </div>
                    <div class="col-sm-6 col-md-10">
                      <h1 class="athlete-header">{{ first_name }} {{ last_name }}</h1>
                      <i class="glyphicon glyphicon-edit athlete-edit"></i>
                      <p style="margin-top:20px">
                        <span><i class="fa fa-group"></i> {{ team }}</span><br />
                        <span><i class="fa fa-calendar"></i> {{ birthday }}</span><br />
                      </p>
                    </div>
                </div>

                <div class="row">
                  <div class="col-lg-3">
                    <h4>Trampoline</h4>
                    <label for="trampoline_level">Level:</label>
                    {{ view Ember.Select content=RoutineManager.athleteLevels optionValuePath=content.key optionLabelPath=content.label }}
                    <select name="trampoline_level">
                      <option></option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <h4>Synchro</h4>
                  </div>
                  <div class="col-lg-3">
                    <h4>Double Mini</h4>
                  </div>
                  <div class="col-lg-3">
                    <h4>Tumbling</h4>
                  </div>
                </div>
            </div>
        </div>
    </div>

  </script>--}}

  @section('js')
  <script src="{{ asset('assets/js/libs/jquery-1.9.1.js') }}"></script>
  <script src="{{ asset('assets/js/libs/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @show

</body>
</html>
