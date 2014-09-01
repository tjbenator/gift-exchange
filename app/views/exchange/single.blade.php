@extends('templates.default')

@section('pagetitle', $exchange->name)
@section('content')
<h3>{{$exchange->name}}</h3>
<a href='{{URL::action('exchange.join', [$exchange->slug] )}}' class='btn btn-success' style="margin-bottom: 10px;">Join</a>
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
		@foreach($exchange->participants() as $participant)
	    <tr>
    		<td>
    			<h3><a href='{{ URL::route('user', [$participant->username]) }}'>{{$participant->name}}</a></h3>
    		</td>
    	</tr>
    	@endforeach
    </tbody>
</table>
@stop