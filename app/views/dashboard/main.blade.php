<a href='{{URL::action('dashboard.account')}}' class='btn btn-warning' style="margin-bottom: 10px;">Edit Account</a>
<a href='{{URL::action('dashboard.edit.wishlist')}}' class='btn btn-warning' style="margin-bottom: 10px;">Edit Wishlist</a>
@if ($user->wishlist())
<div class='well'>
{{ nl2br(autolink($user->wishlist()->pluck('wishlist'), 50, ' rel="nofollow"')) }}
</div>
@endif


<table class='table table-hover'>
	<thead>
		<tr>
			<th class=''>
				Exchanges you are participating in <span class="badge">{{$user->exchanges->count()}}</span>
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
	   	@if($user->exchanges()->count() < 1)
    	<tr>
    		<td><i class='fa fa-gift fa-3x'></i></td>
    		<td></td>
    		<td></td>
    	</tr>
    	@else
			@foreach($user->exchanges()->get() as $exchange)
		    <tr>
	    		<td>
	    			<h3><a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a></h3>
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


<table class='table table-hover'>
	<thead>
		<tr>
			<th>
				Exchanges owned by you <span class="badge">{{$user->made()->count()}}</span>
			</th>
			<th>
				Draw Date
			</th>
			<th>
				Give At
			</th>
		</tr>
	</thead>
	<tbody>
	   	@if($user->made()->count() < 1)
    	<tr>
    		<td> <i class='fa fa-gift fa-3x'></i></td>
    		<td></td>
    		<td></td>
    		<td></td>
    	</tr>
    	@else
			@foreach($user->made()->get() as $exchange)
		    <tr>
	    		<td>
	    			<h3><a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a></h3>
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
