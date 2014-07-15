@extends('master')

@section('content')
<div class="banner-image"><img alt="Quiz Banner" width="800" src="/assets/{{$quiz->banner}}" onerror="this.src = '/assets/banner.png';"></img></div>
    <!--
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Nội dung sự kiện</a></li>
      <li class=""><a href="#profile" data-toggle="tab">Code của bạn</a></li>
      <li class=""><a href="#rank" data-toggle="tab">Bảng xếp hạng</a></li>
    </ul>
  -->
    <div id='content-wrapper'>
    <p><b>Bạn đã trả lời câu hỏi này.</b></p>
    </div>
@stop