{{ Form::model($wishlist, array('route' => ['dashboard.edit.wishlist'], 'class' => 'form-horizontal', 'role' => 'form')) }}
	<div class="form-group">
		{{ Form::label('wishlist', 'wishlist', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::textarea('wishlist', Input::old('wishlist'), array('placeholder' => 'Things I want', 'autofocus', 'class' => 'form-control')) }}
		</div>
	</div>
	{{ Form::submit('Save', array('class' => 'btn btn-default')) }}
{{ Form::close() }}