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

	<div class="row">
		<div class="col-xs-3">
			<div class="form-group">
				{{ Form::label('spending_limit', 'Spending Limit') }}
				<div class="input-group">
					<div class="input-group-addon">$</div>
					{{ Form::number('spending_limit', null, array('class' => 'form-control', 'placeholder' => 'In USD')) }}
					<div class="input-group-addon">.00</div>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="form-group">
				{{ Form::label('draw_at', 'Draw At') }}
				{{ Form::input('date', 'draw_at', null, array('class' => 'form-control')) }} 
			</div>
		</div>
	</div>

	<div class="checkbox">
		<label>
		{{ Form::checkbox('hidden') }} Hide from front page
		</label>
	</div>

{{ Form::submit('Create', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>
