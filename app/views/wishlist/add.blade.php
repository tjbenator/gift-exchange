@extends('templates.default')

@section('pagetitle', 'Add to ' . $wishlist->name)
@section('content')
<h3>Add to {{$wishlist->name}}</h3>
<div class='well'>
{{ Form::open(array('action' => array('WishlistController@postAdd', $wishlist->slug))) }}
	<div class="form-group">
	{{ Form::label('wishlist', 'Wishlist') }}
	{{ Form::textarea('wishlist', Input::old('wishlist'), array('placeholder' => 'Item per line', 'autofocus', 'class' => 'form-control')) }}
	</div>
{{ Form::submit('Join', array('class' => "btn btn-success")) }}
{{ Form::close() }}
</div>
@stop