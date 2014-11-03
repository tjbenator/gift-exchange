<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			@if(!$exchange->processed)
			<div class="panel panel-primary exchange-stage">
			@else
			<div class="panel panel-default exchange-stage">
			@endif
  				<div class="panel-heading"><strong>Exchange Created</strong></div>
  				<div class="panel-body">
					<abbr title='Spending Limit' class='initialism'>
						<i class="fa fa-money"></i>
						@if(Auth::check())
							@currency($exchange->spending_limit, Auth::User()->currency)
						@else
							@currency($exchange->spending_limit)<br />
						@endif
					</abbr><br />

					<abbr title='Creator' class='initialism'>
						<a href="{{ URL::route('user', [$exchange->creator()->pluck('username')]) }}">
							<i class='fa fa-user'></i>  {{ $exchange->creator()->pluck('username') }}
						</a>
					</abbr><br />

					@if(Auth::check() && $exchange->creator()->pluck('id') == Auth::User()->id)
						<abbr title='Passphrase' class='initialism'>
							<i class="fa fa-lock"></i> {{ $exchange->passphrase }}
						</abbr>
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
			@if($exchange->processed && time() < $exchange->rawGiveAt() )
				<div class="panel panel-primary exchange-stage">
			@else
				<div class="panel panel-default exchange-stage">
			@endif
				<div class="panel-heading"><strong>Drawing</strong></div>
				<div class="panel-body">
					<i class='fa fa-calendar'></i> {{ $exchange->draw_at }}<br />
					@if($exchange->processed && time() < $exchange->rawGiveAt() )
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
			@if(time() >= $exchange->rawGiveAt() && $exchange->processed)
				<div class="panel panel-primary exchange-stage">
			@else
				<div class="panel panel-default exchange-stage">
			@endif
				<div class="panel-heading"><strong>Results</strong></div>
				<div class="panel-body">
					<i class='fa fa-calendar'></i> {{ $exchange->give_at }}<br />
					@if(time() >= $exchange->rawGiveAt() && $exchange->processed)
						<i class='fa fa-bullhorn'></i> Results are below
					@endif
				</div>
			</div>
	</div>
</div>

<div class='well' style="margin-top: 15px;">
	@if ($exchange->description)
		{{$exchange->description}}
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
			@if ($surprise->giver == Auth::User() || ($surprise->gifty == Auth::User() && $exchange->rawGiveAt() <= time()))
	    	<tr class="info">
	    	@else
	    	<tr>
	    	@endif
	    		<td>
    				<a href='{{ URL::route('user', [$surprise->giver->username]) }}'>{{ $surprise->giver->username }}</a>
    			</td>
    			<td>
					<i class='fa fa-gift fa-5x'></i>&nbsp;&nbsp;&nbsp;<i class='fa fa-long-arrow-right fa-5x'></i>
    			</td>
    			<td>
				@if($exchange->rawGiveAt() <= time() || Auth::User()->id === $surprise->giver->id)
    					<a href='{{ URL::route('user', [$surprise->gifty->username]) }}'>{{ $surprise->gifty->username }}</a>
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
    				<a href='{{ URL::route('user', [$participant->username]) }}'>{{$participant->username}}</a>
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
