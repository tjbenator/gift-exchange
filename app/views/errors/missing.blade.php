<div class="jumbotron">
  <div class="container" style="text-align: center;">
		<i class="glyphicon glyphicon-exclamation-sign" style="font-size: 196px;"></i><br />
		<h2>
		@if (strlen($exception) > 0)
			{{ $exception }}
		@else
			Page not found!
		@endif
		</h2>
	</div>
</div>