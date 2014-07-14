@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'question-edit']) ?>
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

@section('edit-question')
<div id='edit-question'>

    {{ Form::open(array('route' => 'editQuestion', 'class' => 'form-horizontal', 'id' => 'form-edit-question')) }}
      <fieldset id='legend-question-edit'>
        <legend>Chỉnh sửa câu hỏi</legend>
        <div class="form-group {{ $errors->has('youtube') ? 'has-error' : '' }}" id="form-group-youtube">
          <label for="youtube" class="col-lg-2 control-label">Youtube Clip ID</label>
          <div class="col-lg-2">
            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Youtube Clip ID" value="{{$question->questionAttributes[0]->content}}">
            {{ Form::errorMsg('youtube') }}
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn btn-success btn-sm" id="button-show-youtube"><i class="fa fa-youtube-play"></i> Kiểm tra video</button>
          </div>
        </div>
        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
          <label for="question" class="col-lg-2 control-label">Câu hỏi</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="question" name="question">{{ $question->question }}</textarea>
            {{ Form::errorMsg('question') }}
          </div>
        </div>
        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
          <label for="answer" class="col-lg-2 control-label">Đáp án</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Đáp án" value="{{ $question->answer }}">
            {{ Form::errorMsg('answer') }}
          </div>
        </div>
        <input type='hidden' name="questionId" value="{{ $question->id }}">
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button id="button-edit-question" type="submit" class="btn btn-primary">CẬP NHẬT</button>
          </div>
        </div>
      </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('content')

@yield('edit-question')

@stop
