<div class="well">
{{ Form::open(array('url' => 'login')) }}
	<div class="form-group">
	{{ Form::label('username', 'Username') }}
	{{ Form::text('username', Input::old('username'), array('placeholder' => 'Username', 'autofocus', 'class' => 'form-control')) }}
	</div>

	<div class="form-group">
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', array('class' => 'form-control')) }}
	</div>
{{ Form::submit('Sign In', array('class' => "btn btn-success")) }} <a class="btn btn-warning" href="{{ URL::to('password/remind') }}">Forgot your password?</a>
{{ Form::close() }}
</div>