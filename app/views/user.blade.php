<h4>Wishlist</h4>

<div class='well'>
@if ($user->wishlist())
{{ nl2br($user->wishlist()->pluck('wishlist')) }}
@endif
</div>

