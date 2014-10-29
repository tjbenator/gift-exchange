<div class="jumbotron">
  <div class="container">
    <h1>Welcome to the {{ Config::get('settings.site_title') }}</h1>
    <p>This is a site where you can do gift exchanges with your friends.</p>
    @if(!Auth::check())
    <p><a href='{{URL::route('login')}}' class="btn btn-success btn-lg">Sign in</a> <a href='{{URL::route('register')}}' class="btn btn-primary btn-lg" role="button">Sign Up &raquo;</a></p>
    @endif        	
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
          Draw On
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
        {{ $exchange->draw_at }}<br />
    </td>
    <td>
      @if(!Auth::check() || !Auth::User()->exchanges()->whereName($exchange->name)->count() > 0)
        <a href='{{URL::action('exchange.join', [$exchange->slug] )}}' class='btn btn-success' style="margin-bottom: 10px;">Join</a>
      @else
        <a href='{{URL::action('exchange.leave', [$exchange->slug] )}}' class='btn btn-warning' style="margin-bottom: 10px;">Leave</a>
      @endif
    </td>
</tr>
@endforeach
</tbody>
</table>

