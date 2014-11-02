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

@if (Auth::check())
<div style="margin-bottom: 10px;">
  <a href='{{URL::action('dashboard.account')}}' class='btn btn-warning'>Edit Account</a>
  <a href='{{URL::action('dashboard.edit.wishlist')}}' class='btn btn-warning'>Edit Wishlist</a>
</div>
@if (Auth::User()->wishlist())
<h3>My Wishlist</h3>
<div class='well'>
{{ nl2br(Auth::User()->wishlist()->pluck('wishlist')) }}
</div>
@endif


<table class='table table-hover'>
  <thead>
    <tr>
      <th class=''>
        Exchanges you are participating in <span class="badge">{{Auth::User()->exchanges->count()}}</span>
      </th>
      <th>
        Draw Date
      </th>
      <th>
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach(Auth::User()->exchanges()->get() as $exchange)
      <tr>
        <td>
          <a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a>
        </td>
        <td>
            {{ $exchange->draw_at }}
        </td>
          <td>
            @include('templates.partials.controls.exchange')
        </td>
      </tr>
      @endforeach
    </tbody>
</table>


<table class='table table-hover'>
  <thead>
    <tr>
      <th>
        Exchanges you own <span class="badge">{{Auth::User()->made()->count()}}</span>
      </th>
      <th>
        Draw Date
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach(Auth::User()->made()->get() as $exchange)
      <tr>
        <td>
          <a href='{{ URL::route('exchange', [$exchange->slug]) }}'>{{$exchange->name}}</a>
        </td>
        <td>
            {{ $exchange->draw_at }}
        </td>
        <td>
        @include('templates.partials.controls.exchange')
      </td>
      </tr>
      @endforeach
    </tbody>
</table>
@endif
</tbody>
</table>

