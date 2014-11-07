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

			Click <a href='{{ URL::route('user', ['user' => $gifty->username]) }}'>here</a> to view their wishlist!
		</div>
	</body>
</html>
