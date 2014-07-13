@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'quiz-edit']) ?>
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

@section('create-quiz')
<div id='edit-quiz'>

    {{ Form::open(array('route' => 'editQuiz', 'class' => 'form-horizontal', 'id' => 'form-edit-quiz', 'files' => true)) }}
      <fieldset id='legend-quiz-create'>
        <legend>Chỉnh sửa Quiz</legend>
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
          <label for="title" class="col-lg-2 control-label">Tiêu đề</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề" value="{{$quiz->title}}">
            {{ Form::errorMsg('title') }}
          </div>
        </div>
        <div class="form-group">
            <label for="banner" class="col-lg-2 control-label">Ảnh banner</label>
            <div class="col-lg-10">
                <input id="banner" name="banner" type="file" accept='image/*'>
                <img src="/assets/uploads/admin/quiz-contest/{{$quiz->banner}}" alt="Ảnh banner" width="120"></img>
            </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          <label for="description" class="col-lg-2 control-label">Mô tả</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="description" name="description">{{$quiz->description}}</textarea>
            {{ Form::errorMsg('description') }}
          </div>
        </div>
        <div class="form-group">
          <label for="privacy" class="col-lg-2 control-label">Privacy</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="privacy" name="privacy">{{$quiz->privacy}}</textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="term" class="col-lg-2 control-label">Luật và điều khoản</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="term" name="term" >{{$quiz->term}}</textarea>

          </div>
        </div>
        <input type="hidden" name="quizId" value="{{$quiz->id}}">
        <!--
        <div class="form-group">
          <label class="col-lg-2 control-label">Radios</label>
          <div class="col-lg-10">
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                Option one is this
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Option two can be something else
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="select" class="col-lg-2 control-label">Selects</label>
          <div class="col-lg-10">
            <select class="form-control" id="select">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <br>
            <select multiple="" class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
    -->
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
          </div>
        </div>
      </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('content')

@yield('create-quiz')

@stop
