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
  @else
    <a href='{{URL::route('exchange.create')}}' class="btn btn-success btn-lg">Create Exchange</a>
	@endif
    </p>
</div>
</div>

<table class='table table-hover'>
  <thead>
    <tr>
      <th>
        All Exchanges <span class="badge">{{Exchange::count()}}</span>
      </th>
      <th>
        Draw Date
      </th>
      <th>
        Give Date
      </th>
      <th>
      </th>
    </tr>
  </thead>
  <tbody>
    @if(Exchange::count() > 0)
      @foreach(Exchange::all() as $exchange)
        <tr>
          <td>
            <a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a>
          </td>
          <td>
              {{ $exchange->draw_at->diffForHumans() }}
          </td>
          <td>
              {{ $exchange->give_at->diffForHumans() }}
          </td>
            <td>
              @include('templates.partials.controls.exchange')
          </td>
        </tr>
        @endforeach
    @else
        <tr>
          <td><i class='fa fa-gift fa-3x'></i></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
    @endif
    </tbody>
</table>

