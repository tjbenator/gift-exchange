<div class="jumbotron">
  <div class="container">
    <h1>Welcome to the {{ Config::get('settings.site_title') }}</h1>
    <p style='text-align: center;'>
        <i class='fa fa-gift fa-5x'></i>
	&nbsp;&nbsp;&nbsp;
        <i class='fa fa-refresh fa-5x fa-spin'></i>
	&nbsp;&nbsp;&nbsp;
        <i class='fa fa-gift fa-5x'></i>
	<br />
	<br />
	@if(!Auth::check())
		<a href='{{URL::route('login')}}' class="btn btn-success btn-lg">Sign in</a> <a href='{{URL::route('register')}}' class="btn btn-primary btn-lg" role="button">Sign Up &raquo;</a>
	@endif
    </p>
</div>
</div>

<div class="container" style="margin-bottom: 20px;">
   <a href='{{URL::route('exchange.create')}}' class="btn btn-success">Create Exchange</a>
</div>

<table class='table table-hover'>
   <thead>
      <tr>
         <th>
          Exchanges
        </th>
        <th>
          Draw Date
        </th>
        <th></th>
    </tr>
</thead>
<tbody>
  @foreach($exchanges as $exchange)
  <tr>
     <td>
        <h3><a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a></h3>
        {{$exchange->description}}
    </td>
    <td>
        <i class='fa fa-calendar'></i> {{ $exchange->draw_at }}
    </td>
    <td>
        @include('templates.partials.controls.exchange')
    </td>
</tr>
@endforeach
</tbody>
</table>

