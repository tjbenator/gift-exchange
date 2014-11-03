<div class="btn-group">
	@if(!Auth::check() || !Auth::User()->exchanges()->whereName($exchange->name)->count() > 0)
		<a href='{{URL::action('exchange.join', [$exchange->slug] )}}' class='btn btn-success @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Join</a>
	@else
		<a href='{{URL::action('exchange.leave', [$exchange->slug] )}}' class='btn btn-warning @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Leave</a>
	@endif
	@if(Auth::check() && $exchange->creator()->pluck('id') == Auth::User()->id)
		<a href='{{URL::action('exchange.delete', [$exchange->slug] )}}' class='btn btn-danger @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Delete</a>
	@endif
</div>