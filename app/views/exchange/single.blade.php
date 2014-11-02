<strong>Spending Limit:</strong> @currency($exchange->spending_limit, Auth::User()->currency)<br />

@if($exchange->processed)
	<i class='fa fa-calendar'></i> Drawing occured on {{ $exchange->draw_at }}
@else
	<i class='fa fa-calendar'></i> Drawing on {{ $exchange->draw_at }}
@endif
<br />

@if($exchange->rawGiveAt() >= time())
	<i class='fa fa-calendar'></i> Results will be displayed on {{ $exchange->give_at }}
@else
	<i class='fa fa-calendar'></i> Results were released as of {{ $exchange->give_at }}
@endif
<br />

@include('templates.partials.controls.exchange')
<div class='well'>
	{{$exchange->description}}
</div>


<table class='table table-hover'>
	<thead>
		<tr>
			<th>
				<i class='fa fa-group'></i> Participants <span class="badge">{{$exchange->participants->count()}}</span>
			</th>
			<th>
			</th>
			<th>
				<i class='fa fa-group'></i> Gave to
			</th>
		</tr>
	</thead>
	<tbody>
		@if($exchange->rawGiveAt() <= time() && $exchange->processed)
			@foreach($exchange->surprises()->get() as $surprise)
	    	<tr>
	    		<td>
    				<h3><a href='{{ URL::route('user', [$surprise->giver->username]) }}'>{{ $surprise->giver->username }}</a></h3>
    			</td>
    			<td>
    				<i class='fa fa-arrow-right fa-5x'></i>
    			</td>
    			<td>
    				<h3><a href='{{ URL::route('user', [$surprise->gifty->username]) }}'>{{ $surprise->gifty->username }}</a></h3>
    			</td>
    		</tr>
	    	@endforeach
		@else
			@foreach($exchange->participants()->get() as $participant)
	    	<tr>
	    		<td>
    				<h3><a href='{{ URL::route('user', [$participant->username]) }}'>{{$participant->username}}</a></h3>
    			</td>
    			<td>
					<i class='fa fa-arrow-right fa-5x'></i>
    			</td>
    			<td>
    				<h3>???</h3>
    			</td>
    		</tr>
	    	@endforeach
	    @endif
    </tbody>
</table>
