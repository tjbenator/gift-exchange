<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $exchange->name }} drawing</h2>
		<div>
			Hello {{ $giver->username }},<br /><br />

			You will be giving a gift to {{ $gifty->username }} with a spending limit of @currency($exchange->spending_limit, $giver->currency).<br /><br />

			<strong>Their current wishlist is:</strong><br />
			{{ nl2br($gifty->wishlist()->pluck('wishlist')) }}
		</div>
	</body>
</html>
