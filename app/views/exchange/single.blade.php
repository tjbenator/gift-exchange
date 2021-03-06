@include('templates.partials.exchanges.badges')
<br />
<br />

<div class="row">
	<div class="col-md-3">
		@if(!$exchange->processed)
		<div class="panel panel-warning exchange-stage">
		@else
		<div class="panel panel-default exchange-stage">
		@endif
				<div class="panel-heading"><strong>Exchange Created</strong></div>
				<div class="panel-body">
				<abbr title="Spending Limit/@currency($exchange->spending_limit, Config::get('currency::default')) . ' ' . Config::get('currency::default')" class='initialism'>
					<i class="fa fa-money"></i>
					@currency($exchange->spending_limit)
				</abbr>
				<br />

				<a href="{{ URL::route('user', [$exchange->initiator->username]) }}">
					<i class='fa fa-user'></i>  {{ $exchange->initiator->username }}
				</a>
				<br />

				@if(Auth::check() && $exchange->initiator->id == Auth::User()->id)
					<strong title='Passphrase'><i class="fa fa-lock"></i> {{ $exchange->passphrase }}</strong>
					<br />
				@endif
				@if(!$exchange->processed)
					<i class="fa fa-check-square"></i> Join now!
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-3 hidden-md hidden-lg">
		<div class="exchange-stage">
			<i class='fa fa-long-arrow-down fa-4x exchange-stage-arrow'></i>
		</div>
	</div>

	<div class="col-md-1 hidden-sm">
		<div class="exchange-stage">
			<i class='fa fa-long-arrow-right fa-4x exchange-stage-arrow'></i>
		</div>
	</div>

	<div class="col-md-4">
		@if($exchange->processed && $exchange->give_at->isFuture())
			<div class="panel panel-primary exchange-stage">
		@else
			<div class="panel panel-default exchange-stage">
		@endif
			<div class="panel-heading"><strong>Drawing</strong></div>
			<div class="panel-body">
				<abbr title='{{ $exchange->draw_at->toDateString() }}' class='initialism'>
				<i class='fa fa-calendar'></i> {{ $exchange->draw_at->diffForHumans() }}
				</abbr><br />
				@if($exchange->processed && $exchange->give_at->isFuture() )
					<i class='fa fa-key'></i> No changes can be made<br />
					<i class='fa fa-envelope'></i> Check your email
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-3  hidden-md hidden-lg">
		<div class="exchange-stage">
			<i class='fa fa-long-arrow-down fa-4x exchange-stage-arrow'></i>
		</div>
	</div>
	
	<div class="col-md-1  hidden-sm">
		<div class="exchange-stage">
			<i class='fa fa-long-arrow-right fa-4x exchange-stage-arrow'></i>
		</div>
	</div>

	<div class="col-md-3">
		@if($exchange->processed && $exchange->give_at->isPast())
			<div class="panel panel-success exchange-stage">
		@else
			<div class="panel panel-default exchange-stage">
		@endif
			<div class="panel-heading"><strong>Results</strong></div>
			<div class="panel-body">
				<abbr title='{{ $exchange->give_at->toDateString() }}' class='initialism'>
					<i class='fa fa-calendar'></i> {{ $exchange->give_at->diffForHumans() }}
				</abbr><br />
				@if($exchange->processed && $exchange->give_at->isPast())
					<i class='fa fa-bullhorn'></i> Results are below
				@endif
			</div>
		</div>
	</div>
</div>


<div class="progress">
	<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{ $exchange->give_at_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $exchange->give_at_percentage }}%">
		<span class="sr-only">{{ $exchange->give_at_percentage }}% Complete (Give at)</span>
	</div>
	<div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="{{ $exchange->draw_at_percentage }}" aria-valuemin="0" aria-valuemax="100"  style="width: {{ $exchange->draw_at_percentage }}%">
		<span class="sr-only">{{ $exchange->draw_at_percentage}}% Complete (Draw At)</span>
	</div>
</div>

<div class='well' style="margin-top: 15px;">
	@if ($exchange->description)
		{{ nl2br(autolink($exchange->description, 50, ' rel="nofollow" target="_blank"')) }}
	@else
		<em>No Description Available</em>
	@endif
</div>



@include('templates.partials.controls.exchange')

<table class='table table-hover'>
	<thead>
		<tr>
			<th>
				<i class='fa fa-user'></i> Participants <span class="badge">{{$exchange->participants->count()}}</span>
			</th>
			<th>
			</th>
			<th>
				<i class='fa fa-user'></i> Gave to
			</th>
		</tr>
	</thead>
	<tbody>
		@if($exchange->processed)
			@foreach($exchange->surprises()->orderByRaw('RAND()')->get() as $surprise)
			@if (Auth::check() && ($surprise->giver == Auth::User() || ($surprise->gifty == Auth::User() && $exchange->give_at->isPast())))
	    	<tr class="info">
	    	@else
	    	<tr>
	    	@endif
	    		<td>
	    			<a href='{{ URL::route('user', [$surprise->giver->username]) }}'>
	    				{{ Gravatar::image($surprise->giver->email, $surprise->giver->username, ['width' => 30, 'height' => 30]); }}
    					{{ $surprise->giver->username }}
    				</a>
    			</td>
    			<td>
					<i class='fa fa-gift fa-5x'></i>&nbsp;&nbsp;&nbsp;<i class='fa fa-long-arrow-right fa-5x'></i>
    			</td>
    			<td>
				@if($exchange->give_at->isPast() || (Auth::check() && Auth::User()->id === $surprise->giver->id))
						<a href='{{ URL::route('user', [$surprise->gifty->username]) }}'>
							{{ Gravatar::image($surprise->gifty->email, $surprise->gifty->username, ['width' => 30, 'height' => 30]); }}
    						{{ $surprise->gifty->username }}
    					</a>
				@else
					???
				@endif
    			</td>
    		</tr>
	    	@endforeach
		@else
			@foreach($exchange->participants()->get() as $participant)
	    	<tr>
	    		<td>
	    			<a href='{{ URL::route('user', [$participant->username]) }}'>
	    				{{ Gravatar::image($participant->email, $participant->username, ['width' => 30, 'height' => 30]); }}
    					{{$participant->username}}
    				</a>
    			</td>
    			<td>
					<i class='fa fa-gift fa-5x'></i>&nbsp;&nbsp;&nbsp;<i class='fa fa-long-arrow-right fa-5x'></i>
    			</td>
    			<td>
    				???
    			</td>
    		</tr>
	    	@endforeach
	    @endif
    </tbody>
</table>
