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
        <div class="form-group">
            <label for="background" class="col-lg-2 control-label">Ảnh nền</label>
            <div class="col-lg-10">
                <input id="background" name="background" type="file" accept='image/*'>
                {{ Form::errorMsg('background') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          <label for="description" class="col-lg-2 control-label">Mô tả</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="description" name="description">{{Input::old('description')}}</textarea>
            <div id="summernote-description">{{Input::old('description')}}</div>
            {{ Form::errorMsg('description') }}
          </div>
        </div>
        <div class="form-group">
          <label for="privacy" class="col-lg-2 control-label">Privacy</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="privacy" name="privacy">{{Input::old('privacy')}}</textarea>
            <div id="summernote-privacy">{{Input::old('privacy')}}</div>
          </div>
        </div>
        <div class="form-group">
          <label for="term" class="col-lg-2 control-label">Luật và điều khoản</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="term" name="term" >{{Input::old('term')}}</textarea>
            <div id="summernote-term">{{Input::old('term')}}</div>
          </div>
        </div>

        <div class="form-group">
          <label for="schedule" class="col-lg-2 control-label">Chọn thời gian làm mới câu hỏi</label>
          <div class="col-lg-10">
            <select class="form-control" id="schedule" name="schedule">
                <option value="00:00">00:00</option>
                <option value="00:15">00:15</option>
                <option value="00:30">00:30</option>
                <option value="00:45">00:45</option>

                <option value="01:00">01:00</option>
                <option value="01:15">01:15</option>
                <option value="01:30">01:30</option>
                <option value="01:45">01:45</option>

                <option value="02:00">02:00</option>
                <option value="02:15">02:15</option>
                <option value="02:30">02:30</option>
                <option value="02:45">02:45</option>

                <option value="03:00">03:00</option>
                <option value="03:15">03:15</option>
                <option value="03:30">03:30</option>
                <option value="03:45">03:45</option>

                <option value="04:00">04:00</option>
                <option value="04:15">04:15</option>
                <option value="04:30">04:30</option>
                <option value="04:45">04:45</option>

                <option value="05:00">05:00</option>
                <option value="05:15">05:15</option>
                <option value="05:30">05:30</option>
                <option value="05:45">05:45</option>

                <option value="06:00">06:00</option>
                <option value="06:15">06:15</option>
                <option value="06:30">06:30</option>
                <option value="06:45">06:45</option>

                <option value="07:00">07:00</option>
                <option value="07:15">07:15</option>
                <option value="07:30">07:30</option>
                <option value="07:45">07:45</option>

                <option value="08:00">08:00</option>
                <option value="08:15">08:15</option>
                <option value="08:30">08:30</option>
                <option value="08:45">08:45</option>

                <option value="09:00">09:00</option>
                <option value="09:15">09:15</option>
                <option value="09:30">09:30</option>
                <option value="09:45">09:45</option>

                <option value="10:00">10:00</option>
                <option value="10:15">10:15</option>
                <option value="10:30">10:30</option>
                <option value="10:45">10:45</option>

                <option value="11:00">11:00</option>
                <option value="11:15">11:15</option>
                <option value="11:30">11:30</option>
                <option value="11:45">11:45</option>

                <option value="12:00">12:00</option>
                <option value="12:15">12:15</option>
                <option value="12:30">12:30</option>
                <option value="12:45">12:45</option>

                <option value="13:00">13:00</option>
                <option value="13:15">13:15</option>
                <option value="13:30">13:30</option>
                <option value="13:45">13:45</option>

                <option value="14:00">14:00</option>
                <option value="14:15">14:15</option>
                <option value="14:30">14:30</option>
                <option value="14:45">14:45</option>

                <option value="15:00">15:00</option>
                <option value="15:15">15:15</option>
                <option value="15:30">15:30</option>
                <option value="15:45">15:45</option>

                <option value="16:00">16:00</option>
                <option value="16:15">16:15</option>
                <option value="16:30">16:30</option>
                <option value="16:45">16:45</option>

                <option value="17:00">17:00</option>
                <option value="17:15">17:15</option>
                <option value="17:30">17:30</option>
                <option value="17:45">17:45</option>

                <option value="18:00">18:00</option>
                <option value="18:15">18:15</option>
                <option value="18:30">18:30</option>
                <option value="18:45">18:45</option>

                <option value="19:00">19:00</option>
                <option value="19:15">19:15</option>
                <option value="19:30">19:30</option>
                <option value="19:45">19:45</option>

                <option value="20:00">20:00</option>
                <option value="20:15">20:15</option>
                <option value="20:30">20:30</option>
                <option value="20:45">20:45</option>

                <option value="21:00">21:00</option>
                <option value="21:15">21:15</option>
                <option value="21:30">21:30</option>
                <option value="21:45">21:45</option>

                <option value="22:00">22:00</option>
                <option value="22:15">22:15</option>
                <option value="22:30">22:30</option>
                <option value="22:45">22:45</option>

                <option value="23:00">23:00</option>
                <option value="23:15">23:15</option>
                <option value="23:30">23:30</option>
                <option value="23:45">23:45</option>
            </select>
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
            <button type="submit" class="btn btn-primary" id="button-create-quiz">TẠO MỚI</button>
          </div>
        </div>
      </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('content')

@yield('create-quiz')

@stop
