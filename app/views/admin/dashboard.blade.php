@extends('admin.master')

@section('panel')
<div class="panel panel-default">
  <div class="panel-body">Ranking</div>
</div>
@stop

@section('content')
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Người chơi</th>
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <th>Email</th>
      <th>Địa điểm</th>
      <th>Số lời mời</th>
    </tr>
  </thead>
  <tbody>
    <?php $count=1; ?>
    @foreach ($groups as $user)
    <tr>
        <td>{{$count}}</td>
        <td>{{$user->fullname}}</td>
        <td>{{$user->gender}}</td>
        <td>{{$user->birthday}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->place}}</td>
        <td>{{$user->amount}}</td>
    </tr>
    <?php $count++ ?>
    @endforeach
  </tbody>
</table>
@stop