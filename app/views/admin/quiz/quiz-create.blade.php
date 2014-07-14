@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'quiz-create']) ?>
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
<div id='create-quiz'>

    {{ Form::open(array('route' => 'createQuiz', 'class' => 'form-horizontal', 'id' => 'form-create-quiz', 'files' => true)) }}
      <fieldset id='legend-quiz-create'>
        <legend>Tạo Quiz mới</legend>
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
          <label for="title" class="col-lg-2 control-label">Tiêu đề</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề" value="{{Input::old('title')}}">
            {{ Form::errorMsg('title') }}
          </div>
        </div>
        <div class="form-group">
            <label for="banner" class="col-lg-2 control-label">Ảnh banner</label>
            <div class="col-lg-10">
                <input id="banner" name="banner" type="file" accept='image/*'>
                {{ Form::errorMsg('banner') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          <label for="description" class="col-lg-2 control-label">Mô tả</label>
          <div class="col-lg-10">
            <!-- <textarea class="form-control" rows="3" id="description" name="description">{{Input::old('description')}}</textarea> -->
            <div id="summernote-description">{{$quiz->description}}</div>
            {{ Form::errorMsg('description') }}
          </div>
        </div>
        <div class="form-group">
          <label for="privacy" class="col-lg-2 control-label">Privacy</label>
          <div class="col-lg-10">
            <!-- <textarea class="form-control" rows="3" id="privacy" name="privacy">{{Input::old('privacy')}}</textarea> -->
            <div id="summernote-privacy">{{$quiz->privacy}}</div>
          </div>
        </div>
        <div class="form-group">
          <label for="term" class="col-lg-2 control-label">Luật và điều khoản</label>
          <div class="col-lg-10">
            <!-- <textarea class="form-control" rows="3" id="term" name="term" >{{Input::old('term')}}</textarea> -->
            <div id="summernote-term">{{$quiz->term}}</div>
          </div>
        </div>
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
            <button type="submit" class="btn btn-primary">TẠO MỚI</button>
          </div>
        </div>
      </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('content')

@yield('create-quiz')

@stop
