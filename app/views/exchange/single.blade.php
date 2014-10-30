@if($exchange->processed)
	<i class='glyphicon glyphicon-share'></i> Drawing occured on {{ $exchange->draw_at }}
@else
	<i class='glyphicon glyphicon-share'></i> Drawing on {{ $exchange->draw_at }}
@endif
@include('templates.partials.controls.exchange')
<div class='well'>
{{$exchange->description}}
</div>


<table class='table table-hover'>
	<thead>
		<tr>
			<th>
				Participants <span class="badge">{{$exchange->participants->count()}}</span>
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