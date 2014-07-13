@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'question-list']) ?>
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

@if (count($quizs[0]->questions) > 0)
    <div id='table-questions' class='col-lg-12'>
        <table class="table table-striped table-hover ">
          <thead>
            <tr>
              <th>#</th>
              <th>Media</th>
              <th>Câu hỏi</th>
              <th>Đáp án</th>
              <th>Thứ tự</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=1; ?>
            @foreach ($quizs[0]->questions as $question)
            <tr>
                <td>{{$count}}</td>
                <td>{{$question->questionAttributes[0]->content}}</td>
                <td>{{$question->question}}</td>
                <td>{{$question->answer}}</td>
                <td>{{$question->priority}}</td>
                <td>{{$question->status}}</td>
                <td>
                    <button class="btn btn-primary btn-xs button-edit-quiz" data-quiz="{{$quiz->id}}"><i class="fa fa-edit"></i> Sửa </button>
                    <button class="btn btn-danger btn-xs button-delete-quiz" data-quiz="{{$quiz->id}}"><i class="fa fa-trash-o"></i> Xoá </button>
                </td>
            </tr>
            <?php $count++ ?>
            @endforeach
          </tbody>
        </table>
    </div>
@else
    <fieldset id='legend-quiz-empty'>
        <legend>Bộ câu hỏi - Chủ đề <span class="text-primary">{{$quizs[0]->title}}</span></legend>
        <p class="text-muted">Bộ câu hỏi đang trống.</p>
    </fieldset>
    <button id="button-create-quiz" type="button" class="btn btn-primary">Tạo câu hỏi</button>
@endif

{{ Form::open(array('route' => 'deleteQuiz', 'id' => 'form-delete-question')) }}
  <input type="hidden" value="-1" name="questionId" id="input-question-id">
  {{ Form::token() }}
{{ Form::close() }}

@stop
