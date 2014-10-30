<a href='{{URL::action('dashboard.edit.wishlist')}}' class='btn btn-warning' style="margin-bottom: 10px;">Edit Wishlist</a>
@if (Auth::User()->wishlist())
<div class='well'>
{{ nl2br(Auth::User()->wishlist()->pluck('wishlist')) }}
</div>
@endif


<table class='table table-hover'>
	<thead>
		<tr>
			<th class=''>
				Exchanges you are participating in <span class="badge">{{Auth::User()->exchanges->count()}}</span>
			</th>
			<th>
				Draw Date
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach(Auth::User()->exchanges()->get() as $exchange)
	    <tr>
    		<td>
    			<h3><a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a></h3>
    		</td>
    		<td>
        		{{ $exchange->draw_at }}
    		</td>
    	    <td>
        		@include('templates.partials.controls.exchange')
   			</td>
    	</tr>
    	@endforeach
    </tbody>
</table>


<table class='table table-hover'>
	<thead>
		<tr>
			<th>
				Exchanges you own <span class="badge">{{Auth::User()->made()->count()}}</span>
			</th>
			<th>
				Draw Date
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach(Auth::User()->made()->get() as $exchange)
	    <tr>
    		<td>
    			<h3><a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a></h3>
    		</td>
			<td>
        		{{ $exchange->draw_at }}
    		</td>
		    <td>
				@include('templates.partials.controls.exchange')
			</td>
    	</tr>
    	@endforeach
    </tbody>
</table>