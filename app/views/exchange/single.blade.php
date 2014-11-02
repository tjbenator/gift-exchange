<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<i class="fa fa-money"></i> <strong>Spending Limit:</strong>
			@if(Auth::check())
				@currency($exchange->spending_limit, Auth::User()->currency)<br />
			@else
				@currency($exchange->spending_limit)<br />
			@endif
		</div>

		<div class="col-md-3">
			@if($exchange->processed)
				<i class='fa fa-calendar'></i> Drawing occured on {{ $exchange->draw_at }}
			@else
				<i class='fa fa-calendar'></i> Drawing on {{ $exchange->draw_at }}
			@endif
		</div>

		<div class="col-md-3">
			@if($exchange->rawGiveAt() >= time())
				<i class='fa fa-calendar'></i> Results will be displayed on {{ $exchange->give_at }}
			@else
				<i class='fa fa-calendar'></i> Results were released as of {{ $exchange->give_at }}
			@endif
		</div>
		<div class="col-md-3">
			<i class='fa fa-user'></i> {{ $exchange->creator()->pluck('username') }}
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
		@if($exchange->rawGiveAt() <= time() && $exchange->processed)
			@foreach($exchange->surprises()->orderByRaw('RAND()')->get() as $surprise)
			@if ($surprise->giver == Auth::User() || $surprise->gifty == Auth::User())
	    	<tr class="success">
	    	@else
	    	<tr>
	    	@endif
	    		<td>
    				<a href='{{ URL::route('user', [$surprise->giver->username]) }}'>{{ $surprise->giver->username }}</a>
    			</td>
    			<td>
    				<i class='fa fa-arrow-right fa-5x'></i>
    			</td>
    			<td>
    				<a href='{{ URL::route('user', [$surprise->gifty->username]) }}'>{{ $surprise->gifty->username }}</a>
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
					<i class='fa fa-arrow-right fa-5x'></i>
    			</td>
    			<td>
    				???
    			</td>
    		</tr>
	    	@endforeach
	    @endif
    </tbody>
</table>
