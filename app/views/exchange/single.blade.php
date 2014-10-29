@if(!Auth::check() || !Auth::User()->exchanges()->whereName($exchange->name)->count() > 0)
	<a href='{{URL::action('exchange.join', [$exchange->slug] )}}' class='btn btn-success' style="margin-bottom: 10px;">Join</a>
@else
	<a href='{{URL::action('exchange.leave', [$exchange->slug] )}}' class='btn btn-warning' style="margin-bottom: 10px;">Leave</a>
@endif
@if(Auth::check() && $exchange->creator()->pluck('id') == Auth::User()->id)
<a href='{{URL::action('exchange.delete', [$exchange->slug] )}}' class='btn btn-danger' style="margin-bottom: 10px;">Delete</a>
@endif
<div class='well'>
{{$exchange->description}}
</div>


<table class='table table-hover'>
	<thead>
		<tr>
			<th>
				Participants
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