@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'question-create']) ?>
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

@section('create-question')
<div id='create-question'>

    {{ Form::open(array('route' => 'createQuestion', 'class' => 'form-horizontal', 'id' => 'form-create-question')) }}
      <fieldset id='legend-question-create'>
        <legend>Tạo câu hỏi mới</legend>
        <div class="form-group {{ $errors->has('youtube') ? 'has-error' : '' }}" id="form-group-youtube">
          <label for="youtube" class="col-lg-2 control-label">Youtube Clip ID</label>
          <div class="col-lg-2">
            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Youtube Clip ID" value="{{Input::old('youtube')}}">
            {{ Form::errorMsg('youtube') }}
          </div>
          <div class="col-lg-2">
            <button type="button" class="btn btn-success btn-sm" id="button-show-youtube"><i class="fa fa-youtube-play"></i> Kiểm tra video</button>
          </div>
        </div>
        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
          <label for="question" class="col-lg-2 control-label">Câu hỏi</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="question" name="question">{{Input::old('question')}}</textarea>
            {{ Form::errorMsg('question') }}
          </div>
        </div>
        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
          <label for="answer" class="col-lg-2 control-label">Đáp án</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Đáp án" value="{{Input::old('answer')}}">
            {{ Form::errorMsg('answer') }}
          </div>
        </div>
        <input type='hidden' name="quizId" value="{{ $quiz->id }}">
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button id="button-create-question" type="submit" class="btn btn-primary">TẠO MỚI</button>
          </div>
        </div>
      </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('content')

@yield('create-question')

@stop
