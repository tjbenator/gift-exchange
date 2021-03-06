<div class='well'>
{{ Form::open(array('url' => 'register')) }}
	<div class="form-group">
	{{ Form::label('username', 'Username') }}
	{{ Form::text('username', Input::old('username'), array('placeholder' => 'Username', 'class' => 'form-control')) }}
	</div>

	<div class="form-group">
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
	{{ Form::label('password_confirmation', 'Confirm password') }}
	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', Input::old('email'), array('placeholder' => 'your@email.com', 'class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('currency', 'Currency') }}
		{{ Form::select('currency', DB::table('currency')->lists('title', 'code')) }}
	</div>
{{ Form::submit('Register', array('class' => 'btn btn-default')) }}
<a class="btn btn-warning" href="{{ URL::to('password/remind') }}">Forgot your password?</a>
</div>
{{ Form::close() }}