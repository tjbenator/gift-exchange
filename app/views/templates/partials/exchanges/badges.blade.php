@if(Auth::check() && $exchange->initiator->id == Auth::User()->id)
  <span class="label label-primary" title="You are the initiator">Initiator</span>
@endif
@if($exchange->created_at->addDay()->isFuture())
  <span class="label label-default" title="Was created in the last day">New</span>
@endif
@if($exchange->draw_at->isPast() && $exchange->give_at->isFuture())
  <span class="label label-warning" title="Has been drawn, and can no longer be joined/edited/deleted">Drawn</span>
@endif
@if($exchange->give_at->isPast())
  <span class="label label-danger" title="Is Over">Over</span>
@endif
@if($exchange->hidden)
  <span class="label label-default" title="Is not displayed on the home page or user profiles">Hidden</span>
@endif