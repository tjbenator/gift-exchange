<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ (isset($title) ? $title . ' | ' : null) . Config::get('settings.site_title') }}</title>

	<!-- Custom styling -->
	{{ HTML::style('css/main.css'); }}
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('home') }}"><i class='fa fa-gift'></i> {{ Config::get('settings.site_title') }}</a>
      </div>
      <div class="navbar-collapse collapse">
        @if(Auth::check())
          <div class="navbar-form navbar-right">
            <a href='{{ URL::route('exchange.create') }}' class='btn btn-success'>Create Exchange</a>
            <a href='{{ URL::route('dashboard') }}' class='btn btn-primary'>Dashboard</a>
            <a href='{{ URL::route('logout') }}' class='btn btn-danger'>Logout</a>
            {{ Gravatar::image(Auth::User()->email, Auth::User()->username, ['width' => 30, 'height' => 30]); }}
          </div>
        @else
          {{ Form::open(array('route' => 'login', 'class' => 'navbar-form navbar-right', 'role' => 'form')) }}
          <div class="form-group">
            {{ Form::text('username', Input::old('username'), array('placeholder' => 'Username', 'autofocus', 'class' => 'form-control')) }}
          </div>
          <div class="form-group">
            {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
          </div>
          {{ Form::submit('Sign In', array('class' => "btn btn-success")) }}
          {{ Form::close() }}
        @endif
      </div><!--/.navbar-collapse -->
    </div>
  </div>

  @if (Session::has('messages'))
    <div class="container">
      <div class="alert alert-success">
        @foreach (Session::get('messages') as $message)
        {{ $message }} <br />
        @endforeach
      </div>
    </div>
  @endif
  @if (count($errors) > 0)
    <div class="container">
      <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
        {{ $error }} <br />
        @endforeach
      </div>
    </div>
  @endif
  @if(isset($title))
    <div class="container">
      <h3>{{ $title }}</h3>
    </div>
  @endif
