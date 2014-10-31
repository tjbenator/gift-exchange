<strong>Spending Limit:</strong> @currency($exchange->spending_limit, Auth::User()->currency)<br />
@if($exchange->processed)
	<i class='fa fa-calendar'></i> Drawing occured on {{ $exchange->draw_at }}
@else
	<i class='fa fa-calendar'></i> Drawing on {{ $exchange->draw_at }}
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
		</tr>
	</thead>
	<tbody>
		@foreach($exchange->participants()->get() as $participant)
	    <tr>
    		<td>
    			<h3><a href='{{ URL::route('user', [$participant->username]) }}'>{{$participant->username}}</a></h3>
    		</td>
    	</tr>
    	@endforeach
    </tbody>
</table>
