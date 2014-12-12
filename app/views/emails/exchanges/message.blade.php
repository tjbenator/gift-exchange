<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>A message from {{ $from }}</h2>
		<div>
			Hello {{ $to->username }},<br /><br />

			{{ $msg }}

			<br /><br />

			<span style="text-transform: capitalize;">{{ $from }}</span>
			
		</div>
	</body>
</html>
