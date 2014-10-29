<div class='well'>
{{ Session::get('error') }}
{{ Session::get('status') }}
{{ Form::open(array('action' => 'RemindersController@postRemind')) }}

	{{ Form::label('email', 'Email') }}
    {{ Form::email('email', Input::old('email'), array('placeholder' => 'email', 'class' => 'form-control')) }}<br />
    {{ Form::submit('Send Reminder', array('class' => 'btn btn-default')) }}<br />

{{ Form::close() }}
</div>