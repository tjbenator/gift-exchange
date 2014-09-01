@extends('templates.default')

@section('pagetitle', 'Create an Exchange')
@section('content')
<div class='well'>
{{ Form::open(array('route' => 'exchange.create')) }}
	<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', Input::old('name'), array('placeholder' => 'My Gift Exchange', 'autofocus', 'class' => 'form-control')) }}
	</div>

	<div class="form-group">
	{{ Form::label('description', 'Description') }}
	{{ Form::text('description', Input::old('description'), array('autofocus', 'class' => 'form-control')) }}
	</div>

	<div class="form-group">
	{{ Form::label('draw_at', 'Draw At') }}
	{{ Form::input('date', 'draw_at', null, array('class' => 'form-control')) }} 
	</div>

	<div class="checkbox">
		<label>
		{{ Form::checkbox('hidden') }} Hide from front page
		</label>
	</div>

{{ Form::submit('Create', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>
@stop
