<div class="btn-group">
	@if(!Auth::check() || !Auth::User()->exchanges()->whereName($exchange->name)->count() > 0)
		<a href='{{URL::action('exchange.join', [$exchange->slug] )}}' class='btn btn-success @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Join</a>
	@elseif($exchange->initiator->id != Auth::User()->id)
		<a href='{{URL::action('exchange.leave', [$exchange->slug] )}}' class='btn btn-warning @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Leave</a>
	@endif
	@if(Auth::check() && $exchange->initiator->id == Auth::User()->id)
		<a href='{{URL::action('exchange.edit', [$exchange->slug] )}}' class='btn btn-warning @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Edit</a>
		<a href='{{URL::action('exchange.delete', [$exchange->slug] )}}' class='btn btn-danger @if($exchange->processed) disabled @endif' style="margin-bottom: 10px;">Delete</a>		
	@endif
	@if(Auth::check() && Auth::User()->exchanges->contains($exchange))
		<a href='{{URL::action('exchange.message', [$exchange->slug])}}' class='btn btn-default @if(!$exchange->processed) disabled @endif' style="margin-bottom: 10px;">Message</a>
	@endif
</div>