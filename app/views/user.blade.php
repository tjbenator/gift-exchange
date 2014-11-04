<h4>Wishlist</h4>

<div class='well'>
@if ($user->wishlist())
{{ nl2br(autolink($user->wishlist()->pluck('wishlist'), 50, ' rel="nofollow"')) }}
@endif
</div>

