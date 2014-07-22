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
          <label for="youtube" class="col-lg-2 control-label">Nội dung câu đố</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="youtube" name="youtube"></textarea>
            <div id="summernote-youtube">{{Input::old('youtube')}}</div>
            {{ Form::errorMsg('youtube') }}
          </div>
        </div>

        <div class="form-group">
          <label for="question-type" class="col-lg-2 control-label">Loại câu hỏi</label>
          <div class="col-lg-10">
            <select class="form-control" id="question-type" name="question-type">
                <option value="text">Điền text</option>
                <option value="choice">Nhiều phương án</option>
            </select>
          </div>
        </div>

        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
          <label for="question" class="col-lg-2 control-label">Câu hỏi</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="question" name="question">{{Input::old('question')}}</textarea>
            {{ Form::errorMsg('question') }}
          </div>
        </div>

        <div id="type-text" class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
          <label for="answer" class="col-lg-2 control-label">Đáp án</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Đáp án" value="{{Input::old('answer')}}">
            {{ Form::errorMsg('answer') }}
          </div>
        </div>

        <div id="type-choice" class="form-group hide">
          <label class="col-lg-2 control-label">Các phương án</label>
          <div id="type-choice-content" class="col-lg-10">

          </div>
        </div>

        <div id="none" class="form-group hide">
          <label class="col-lg-2 control-label"></label>
          <div class="col-lg-2">
            <button type="button" class="btn btn-link" id="button-add-choice">Thêm phương án trả lời</button>
          </div>
          <div class="col-lg-5">
            <input type="text" class="form-control" id="choice-add-content" placeholder="Phương án mới" value="">
          </div>
        </div>

        <div class="form-group hide" id="type-choice-answer">
          <label for="select" class="col-lg-2 control-label">Đáp án</label>
          <div class="col-lg-10">
            <select class="form-control" id="choice-answer" name="choice-answer">

            </select>
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
