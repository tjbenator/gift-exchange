@extends('templates.default')

@section('pagetitle', 'Password Reset')

@section('content')
<div class='well'>
{{ Session::get('error') }}

{{ Form::open(array('action' => 'RemindersController@postReset')) }}
    {{ Form::hidden('token', $token) }}

    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', Input::old('email'), array('placeholder' => 'email', 'class' => 'form-control')) }}<br />

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'form-control')) }}<br />
    
    {{ Form::label('password_confirmation', 'Password Again') }}
    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}<br />

    {{ Form::submit('Reset Password', array('class' => 'btn btn-default')) }}<br />
{{ Form::close() }}
</div>
@stop