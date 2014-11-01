<div class='well'>
{{ Form::model(Auth::user(), array('action' => 'UserDashboardController@postEditAccount')) }}
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Auth::User()->email, array('placeholder' => 'email',  'class' => 'form-control')) }}
    </div>
    <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    {{ Form::label('newpassword', 'New Password') }}
                    {{ Form::password('newpassword',  array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    {{ Form::label('newpassword_confirmation', 'New Password Again') }}
                    {{ Form::password('newpassword_confirmation',  array('class' => 'form-control')) }}
                </div>
            </div>
    </div>
    <div class="form-group">
	   {{ Form::label('password', 'Current Password*') }}
       {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('currency', 'Currency') }}
        {{ Form::select('currency', DB::table('currency')->lists('title', 'code')) }}
    </div>


    <i>Current password is required</i><br />
    {{ Form::submit('Save', array('class' => 'btn btn-success')) }}<br />
{{ Form::close() }}
</div>