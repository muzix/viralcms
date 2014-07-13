@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'dashboard']) ?>
@stop

@section('current_app')
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Rủ ảo trúng thật <b class="caret"></b></a>
@stop

@section('panel')
<div class='col-lg-2' id='content'>
<div class="list-group">
  <a href="#" class="list-group-item" id='panel-ranking'>Bảng xếp hạng
  </a>
  <a href="#" class="list-group-item" id='panel-code'>Danh sách code
  </a>
</div>
</div>
@stop

@section('content')
<div class='col-lg-10' id='content'>
<div id='table-ranking'>
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
</div>

<div id='table-code'>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Người chơi</th>
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <th>Email</th>
      <th>Địa điểm</th>
      <th>Code</th>
    </tr>
  </thead>
  <tbody>
    <?php $count2=1; ?>
    @foreach ($codes as $user)
    <?php $code = 'GLX'.str_pad($user->id, 8, '0', STR_PAD_LEFT); ?>
    <tr>
        <td>{{$count2}}</td>
        <td>{{$user->fullname}}</td>
        <td>{{$user->gender}}</td>
        <td>{{$user->birthday}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->place}}</td>
        <td>{{$code}}</td>
    </tr>
    <?php $count2++ ?>
    @endforeach
  </tbody>
</table>
</div>
</div>
@stop