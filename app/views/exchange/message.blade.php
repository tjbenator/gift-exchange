<div class='well'>

{{ Form::open(['action' => ['ExchangeController@postMessage', $exchange->slug]]) }}

	<div class="form-group">
		{{ Form::label('whom', 'Whom:') }}
		{{ Form::select('whom', array('gifter' => 'Your Gifter', 'gifty' => 'Your Gifty (' . $exchange->surprises()->whereGiverId(Auth::User()->id)->first()->gifty->username . ')')) }}
	</div>
	<div class="form-group">
		{{ Form::label('message', 'Message') }}
		{{ Form::textarea('message', Input::old('message'), array('autofocus', 'class' => 'form-control')) }}
	</div>

	
{{ Form::submit('Send', array('class' => "btn btn-success")) }}

{{ Form::close() }}
</div>
