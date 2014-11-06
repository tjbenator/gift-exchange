<div class='row'>
	@foreach($users as $user)
		<div class='col-md-3'>
			<a href="{{ URL::Route('user', ['user' => $user->username])}}" class="thumbnail" style="text-align: center;">
				{{ Gravatar::image($user->email, $user->username, ['width' => 250, 'height' => 250]); }}
				<div class="caption">
					<strong>{{ $user->username }}</strong>
				</div>
			</a>
		</div>
	@endforeach
</div>