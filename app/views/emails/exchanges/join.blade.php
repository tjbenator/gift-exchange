<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $user->username }} has joined {{ $exchange->name }}</h2>
		<div>
			Hello {{ $exchange->initiator->username }},<br /><br />
			{{ $user->username }} has joined an exchange you initiated called {{ $exchange->name }}.
		</div>
	</body>
</html>
