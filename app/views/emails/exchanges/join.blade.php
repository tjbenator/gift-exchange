<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $user->username }} has joined {{ $exchange->name }}</h2>
		<div>
			Hello {{ $exchange->creator->username }},<br /><br />
			$user->username has joined your exchange titled {{ $exchange->name }}.
		</div>
	</body>
</html>
