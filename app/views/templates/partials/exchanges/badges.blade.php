@if(Auth::check() && $exchange->initiator->id == Auth::User()->id)
  <span class="label label-primary" title="You are the initiator">Initiator</span>
@endif
@if($exchange->created_at->addDay()->isFuture())
  <span class="label label-default">New</span>
@endif
@if($exchange->draw_at->isPast() && $exchange->give_at->isFuture())
  <span class="label label-warning">Drawn</span>
@endif
@if($exchange->give_at->isPast())
  <span class="label label-danger">Over</span>
@endif