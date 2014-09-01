@extends('templates.default')

@section('pagetitle', $user->username . "'s Wishlists")
@section('content')
    <table class='table table-hover'>
    	<thead>
    		<tr>
    			<th>
    				{{ $user->username }}'s Wishlists
    			</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($user->wishlists() as $wishlist)
		    <tr>
	    		<td>
	    			<h3>{{$wishlist->name}}</h3>
	    		</td>
	    		<td>

	    		</td>
	    	</tr>
	    	@endforeach
	    </tbody>
    </table>
@stop
