<div class='well'>
{{ Form::open(array('action' => array('ExchangeController@postJoin', $exchange->slug))) }}
Are you sure you want to join {{ $exchange->name }}?<br />
	<div class="form-group">
		{{ Form::label('passphrase', 'Passphrase') }}
		{{ Form::input('text', 'passphrase', null, array('class' => 'form-control')) }} 
	</div>
{{ Form::submit('Yes!', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>