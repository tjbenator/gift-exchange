<div class='well'>
{{ Form::open(array('action' => array('ExchangeController@postLeave', $exchange->slug))) }}
Are you sure you want to leave {{ $exchange->name }}?<br />
{{ Form::submit('Yes!', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>