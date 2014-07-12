@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'quizcontest.create']) ?>
@stop

@section('current_app')
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Quiz Contest <b class="caret"></b></a>
@stop

@section('title')

@stop

@section('breadcumb')
<ul class="breadcrumb">
  <li class="active">Home</li>
</ul>
@stop

@section('content')

@if (count($quizs) > 0)
    <div id='table-quizs' class='col-lg-8'>
        <table class="table table-striped table-hover ">
          <thead>
            <tr>
              <th>#</th>
              <th>Chủ đề</th>
              <th>Trạng thái</th>
              <th>Ngày cập nhật</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=1; ?>
            @foreach ($quizs as $quiz)
            <tr>
                <td>{{$count}}</td>
                <td>{{$quiz->title}}</td>
                <td>{{$quiz->description}}</td>
                <td>{{$quiz->updated_at}}</td>
                <td>
                    <button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Sửa </button>
                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Xoá </button>
                </td>
            </tr>
            <?php $count++ ?>
            @endforeach
          </tbody>
        </table>
    </div>
@else
    <fieldset id='legend-quiz-empty'>
        <legend>Chủ đề</legend>
        <p class="text-muted">Bạn chưa có chủ đề nào.</p>
    </fieldset>
    <button id="button-create-quiz" type="button" class="btn btn-primary">Tạo chủ đề mới</button>
@endif

@stop
