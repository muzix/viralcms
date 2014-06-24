@extends('layout')

@section('content')
    @foreach($users as $user)
        <p>{{ $user->shortname }} <strong>{{ $user->email }}</strong> </p>
    @endforeach
@stop