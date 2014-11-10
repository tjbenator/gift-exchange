<div class="jumbotron">
  <div class="container" style='text-align: center;'>
    <h1>Welcome to the {{ Config::get('settings.site_title') }}</h1>
    <p>
      <i title="You" class='fa fa-gift fa-5x'></i>
      &nbsp;&nbsp;&nbsp;
      <i title="I'm dizzy &gt;,&lt;" class='fa fa-refresh fa-5x fa-spin'></i>
      &nbsp;&nbsp;&nbsp;
      <i title="Your penguin friend" class='fa fa-gift fa-5x'></i>
    	<br />
    	<br />
      @if(!Auth::check())
        <a title="It's the right thing to do" href='{{URL::route('login')}}' class="btn btn-success btn-lg">Sign in</a> <a href='{{URL::route('register')}}' class="btn btn-primary btn-lg" role="button">Sign Up &raquo;</a>
      @else
        <a title="Let's get this party started!" href='{{URL::route('exchange.create')}}' class="btn btn-success btn-lg">Create Exchange</a>
        <a title="We are your friends!" href='{{URL::route('users')}}' class="btn btn-primary btn-lg">User List</a>
      @endif
    </p>
  </div>
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
      <th>
        Give Date
      </th>
      <th>
      </th>
    </tr>
  </thead>
  <tbody>
    @if($exchanges->count() > 0)
      @foreach($exchanges as $exchange)
        <tr>
          <td>
            @include('templates.partials.exchanges.badges')
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
{{ $exchanges->links() }}<br />