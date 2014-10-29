{{ Form::model($exchange, array('route' => ['exchange.delete', $exchange->slug], 'class' => 'form-horizontal', 'role' => 'form')) }}
	<div class="form-group">
		{{ Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('confirm', '', array('placeholder' => 'Type exchange name', 'autofocus', 'class' => 'form-control')) }}
		</div>
	</div>

	{{ Form::submit('Delete ' . $exchange->name, array('class' => 'btn btn-default')) }}
{{ Form::close() }}