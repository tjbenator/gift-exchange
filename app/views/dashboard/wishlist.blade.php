{{ Form::model($wishlist, array('action' => 'UserDashboardController@postWishlist', 'class' => 'form-horizontal', 'role' => 'form')) }}

	{{ Form::textarea('wishlist', Input::old('wishlist'), array('placeholder' => 'Things I want', 'autofocus', 'class' => 'form-control')) }}
	<br />
	{{ Form::submit('Save', array('class' => 'btn btn-default')) }} <a class='btn btn-warning' target='_blank' href='{{ URL::route('how-to-wishlist') }}'>Help?</a>
{{ Form::close() }}