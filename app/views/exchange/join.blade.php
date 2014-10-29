<div class='well'>
{{ Form::open(array('action' => array('ExchangeController@postJoin', $exchange->slug))) }}
Are you sure you want to join {{ $exchange->name }}?<br />
{{ Form::submit('Yes!', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>