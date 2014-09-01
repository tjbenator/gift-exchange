@extends('templates.default')

@section('pagetitle', 'Join ' . $exchange->name)
@section('content')
<h3>Join {{$exchange->name}}</h3>
<div class='well'>
{{ Form::open(array('action' => array('ExchangeController@postJoin', $exchange->slug))) }}
	<div class="form-group">
	{{ Form::label('wishlist', 'Wishlist') }}
	{{ Form::textarea('wishlist', Input::old('wishlist'), array('placeholder' => 'Item per line', 'autofocus', 'class' => 'form-control')) }}
	</div>
{{ Form::submit('Join', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>
@stop