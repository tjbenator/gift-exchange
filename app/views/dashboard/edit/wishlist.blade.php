{{ Form::model($wishlist, array('route' => ['dashboard.edit.wishlist'], 'class' => 'form-horizontal', 'role' => 'form')) }}

	{{ Form::textarea('wishlist', Input::old('wishlist'), array('placeholder' => 'Things I want', 'autofocus', 'class' => 'form-control')) }}
	<br />
	{{ Form::submit('Save', array('class' => 'btn btn-default')) }}
{{ Form::close() }}