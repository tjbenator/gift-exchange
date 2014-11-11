<h4>Wishlist</h4>

<div class='well'>
@if ($user->wishlist())
{{ nl2br(autolink($user->wishlist()->pluck('wishlist'), 50, ' rel="nofollow"')) }}
@endif
</div>

<table class='table table-hover'>
	<thead>
		<tr>
			<th class=''>
				Exchanges {{ $user->username }} is participating in <span class="badge">{{$user->exchanges->count()}}</span>
			</th>
			<th>
				Draw Date
			</th>
			<th>
				Give Date
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
	   	@if($user->exchanges()->where('hidden', 0)->count() < 1)
    	<tr>
    		<td><i class='fa fa-gift fa-3x'></i></td>
    		<td></td>
    		<td></td>
    	</tr>
    	@else
			@foreach($user->exchanges()->where('hidden', 0)->get() as $exchange)
		    <tr>
	    		<td>
	    			@include('templates.partials.exchanges.badges')
	    			<a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a>
	    		</td>
	    		<td>
	        		{{ $exchange->draw_at->diffForHumans() }}
	    		</td>
	    		<td>
	    			{{ $exchange->give_at->diffForHumans() }}
	    		</td>
	    	    <td>
	        		@include('templates.partials.controls.exchange')
	   			</td>
	    	</tr>
	    	@endforeach
 
    	@endif
    </tbody>
</table>