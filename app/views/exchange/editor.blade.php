<div class='well'>
@if(isset($exchange))
{{ Form::model($exchange, array('route' => ['exchange.edit', $exchange->slug])) }}
@else
{{ Form::open(array('route' => 'exchange.create')) }}
@endif
	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', Input::old('name'), array('placeholder' => 'My Gift Exchange', 'autofocus', 'class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::textarea('description', Input::old('description'), array('autofocus', 'class' => 'form-control')) }}
	</div>

	<div class="row">
		<div class="col-xs-3">
			<div class="form-group">
				{{ Form::label('passphrase', 'Passphrase') }}
				{{ Form::input('text', 'passphrase', null, array('class' => 'form-control', 'placeholder' => 'Secret')) }} 
			</div>
		</div>
		<div class="col-xs-3">
			<div class="form-group">
				{{ Form::label('spending_limit', 'Spending Limit') }}
				<div class="input-group">
					<div class="input-group-addon">$</div>
					{{ Form::number('spending_limit', null, array('class' => 'form-control', 'placeholder' => 'In ' . Config::get('currency::default'))) }}
					<div class="input-group-addon">
						.00
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="form-group">
				{{ Form::label('draw_at', 'Draw At') }}
				@if(isset($exchange))
				{{ Form::input('date', 'draw_at', null, array('class' => 'form-control', 'readonly')) }} 
				@else
				{{ Form::input('date', 'draw_at', null, array('class' => 'form-control')) }} 
				@endif
			</div>
		</div>
		<div class="col-xs-3">
			<div class="form-group">
				{{ Form::label('give_at', 'Give At') }}
				@if(isset($exchange))
				{{ Form::input('date', 'give_at', null, array('class' => 'form-control', 'readonly')) }} 
				@else
				{{ Form::input('date', 'give_at', null, array('class' => 'form-control')) }} 
				@endif
			</div>
		</div>
	</div>

	<div class="checkbox">
		<label>
		{{ Form::checkbox('hidden') }} Hide from front page
		</label>
	</div>

@if(isset($exchange))
	{{ Form::submit('Save', array('class' => "btn btn-success")) }}
@else
	{{ Form::submit('Create', array('class' => "btn btn-success")) }}
@endif
{{ Form::close() }}
</div>
