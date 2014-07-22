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
                <br/>
                <img src="{{{url('/assets/'.$quiz->banner)}}}" alt="Ảnh banner" width="120"
                onerror="this.src = 'http://placehold.it/120x120';"></img>
            </div>
        </div>
        <div class="form-group">
            <label for="background" class="col-lg-2 control-label">Ảnh nền</label>
            <div class="col-lg-10">
                <input id="background" name="background" type="file" accept='image/*'>
                <br/>
                <img src="{{{url('/assets/'.$quiz->background)}}}" alt="Ảnh nền" width="120"
                onerror="this.src = 'http://placehold.it/120x120';"></img>
            </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          <label for="description" class="col-lg-2 control-label">Mô tả</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="description" name="description">{{$quiz->description}}</textarea>
            <div id="summernote-description">{{$quiz->description}}</div>
            {{ Form::errorMsg('description') }}
          </div>
        </div>
        <div class="form-group">
          <label for="privacy" class="col-lg-2 control-label">Privacy</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="privacy" name="privacy">{{$quiz->privacy}}</textarea>
            <div id="summernote-privacy">{{$quiz->privacy}}</div>
          </div>
        </div>
        <div class="form-group">
          <label for="term" class="col-lg-2 control-label">Luật và điều khoản</label>
          <div class="col-lg-10">
            <textarea class="form-control hide" rows="3" id="term" name="term" >{{$quiz->term}}</textarea>
            <div id="summernote-term">{{$quiz->term}}</div>
          </div>
        </div>

        <div class="form-group">
          <label for="schedule" class="col-lg-2 control-label">Chọn thời gian làm mới câu hỏi</label>
          <div class="col-lg-10">
            <select class="form-control" id="schedule" name="schedule">
                <option value="00:00" @if($schedule->start_time === '00:00') selected @else @endif>00:00</option>
                <option value="00:15" @if($schedule->start_time === '00:15') selected @else @endif>00:15</option>
                <option value="00:30" @if($schedule->start_time === '00:30') selected @else @endif>00:30</option>
                <option value="00:45" @if($schedule->start_time === '00:45') selected @else @endif>00:45</option>

                <option value="01:00" @if($schedule->start_time === '01:00') selected @else @endif>01:00</option>
                <option value="01:15" @if($schedule->start_time === '01:15') selected @else @endif>01:15</option>
                <option value="01:30" @if($schedule->start_time === '01:30') selected @else @endif>01:30</option>
                <option value="01:45" @if($schedule->start_time === '01:45') selected @else @endif>01:45</option>

                <option value="02:00" @if($schedule->start_time === '02:00') selected @else @endif>02:00</option>
                <option value="02:15" @if($schedule->start_time === '02:15') selected @else @endif>02:15</option>
                <option value="02:30" @if($schedule->start_time === '02:30') selected @else @endif>02:30</option>
                <option value="02:45" @if($schedule->start_time === '02:45') selected @else @endif>02:45</option>

                <option value="03:00" @if($schedule->start_time === '03:00') selected @else @endif>03:00</option>
                <option value="03:15" @if($schedule->start_time === '03:15') selected @else @endif>03:15</option>
                <option value="03:30" @if($schedule->start_time === '03:30') selected @else @endif>03:30</option>
                <option value="03:45" @if($schedule->start_time === '03:45') selected @else @endif>03:45</option>

                <option value="04:00" @if($schedule->start_time === '04:00') selected @else @endif>04:00</option>
                <option value="04:15" @if($schedule->start_time === '04:15') selected @else @endif>04:15</option>
                <option value="04:30" @if($schedule->start_time === '04:30') selected @else @endif>04:30</option>
                <option value="04:45" @if($schedule->start_time === '04:45') selected @else @endif>04:45</option>

                <option value="05:00" @if($schedule->start_time === '05:00') selected @else @endif>05:00</option>
                <option value="05:15" @if($schedule->start_time === '05:15') selected @else @endif>05:15</option>
                <option value="05:30" @if($schedule->start_time === '05:30') selected @else @endif>05:30</option>
                <option value="05:45" @if($schedule->start_time === '05:45') selected @else @endif>05:45</option>

                <option value="06:00" @if($schedule->start_time === '06:00') selected @else @endif>06:00</option>
                <option value="06:15" @if($schedule->start_time === '06:15') selected @else @endif>06:15</option>
                <option value="06:30" @if($schedule->start_time === '06:30') selected @else @endif>06:30</option>
                <option value="06:45" @if($schedule->start_time === '06:45') selected @else @endif>06:45</option>

                <option value="07:00" @if($schedule->start_time === '07:00') selected @else @endif>07:00</option>
                <option value="07:15" @if($schedule->start_time === '07:15') selected @else @endif>07:15</option>
                <option value="07:30" @if($schedule->start_time === '07:30') selected @else @endif>07:30</option>
                <option value="07:45" @if($schedule->start_time === '07:45') selected @else @endif>07:45</option>

                <option value="08:00" @if($schedule->start_time === '08:00') selected @else @endif>08:00</option>
                <option value="08:15" @if($schedule->start_time === '08:15') selected @else @endif>08:15</option>
                <option value="08:30" @if($schedule->start_time === '08:30') selected @else @endif>08:30</option>
                <option value="08:45" @if($schedule->start_time === '08:45') selected @else @endif>08:45</option>

                <option value="09:00" @if($schedule->start_time === '09:00') selected @else @endif>09:00</option>
                <option value="09:15" @if($schedule->start_time === '09:15') selected @else @endif>09:15</option>
                <option value="09:30" @if($schedule->start_time === '09:30') selected @else @endif>09:30</option>
                <option value="09:45" @if($schedule->start_time === '09:45') selected @else @endif>09:45</option>

                <option value="10:00" @if($schedule->start_time === '10:00') selected @else @endif>10:00</option>
                <option value="10:15" @if($schedule->start_time === '10:15') selected @else @endif>10:15</option>
                <option value="10:30" @if($schedule->start_time === '10:30') selected @else @endif>10:30</option>
                <option value="10:45" @if($schedule->start_time === '10:45') selected @else @endif>10:45</option>

                <option value="11:00" @if($schedule->start_time === '11:00') selected @else @endif>11:00</option>
                <option value="11:15" @if($schedule->start_time === '11:15') selected @else @endif>11:15</option>
                <option value="11:30" @if($schedule->start_time === '11:30') selected @else @endif>11:30</option>
                <option value="11:45" @if($schedule->start_time === '11:45') selected @else @endif>11:45</option>

                <option value="12:00" @if($schedule->start_time === '12:00') selected @else @endif>12:00</option>
                <option value="12:15" @if($schedule->start_time === '12:15') selected @else @endif>12:15</option>
                <option value="12:30" @if($schedule->start_time === '12:30') selected @else @endif>12:30</option>
                <option value="12:45" @if($schedule->start_time === '12:45') selected @else @endif>12:45</option>

                <option value="13:00" @if($schedule->start_time === '13:00') selected @else @endif>13:00</option>
                <option value="13:15" @if($schedule->start_time === '13:15') selected @else @endif>13:15</option>
                <option value="13:30" @if($schedule->start_time === '13:30') selected @else @endif>13:30</option>
                <option value="13:45" @if($schedule->start_time === '13:45') selected @else @endif>13:45</option>

                <option value="14:00" @if($schedule->start_time === '14:00') selected @else @endif>14:00</option>
                <option value="14:15" @if($schedule->start_time === '14:15') selected @else @endif>14:15</option>
                <option value="14:30" @if($schedule->start_time === '14:30') selected @else @endif>14:30</option>
                <option value="14:45" @if($schedule->start_time === '14:45') selected @else @endif>14:45</option>

                <option value="15:00" @if($schedule->start_time === '15:00') selected @else @endif>15:00</option>
                <option value="15:15" @if($schedule->start_time === '15:15') selected @else @endif>15:15</option>
                <option value="15:30" @if($schedule->start_time === '15:30') selected @else @endif>15:30</option>
                <option value="15:45" @if($schedule->start_time === '15:45') selected @else @endif>15:45</option>

                <option value="16:00" @if($schedule->start_time === '16:00') selected @else @endif>16:00</option>
                <option value="16:15" @if($schedule->start_time === '16:15') selected @else @endif>16:15</option>
                <option value="16:30" @if($schedule->start_time === '16:30') selected @else @endif>16:30</option>
                <option value="16:45" @if($schedule->start_time === '16:45') selected @else @endif>16:45</option>

                <option value="17:00" @if($schedule->start_time === '17:00') selected @else @endif>17:00</option>
                <option value="17:15" @if($schedule->start_time === '17:15') selected @else @endif>17:15</option>
                <option value="17:30" @if($schedule->start_time === '17:30') selected @else @endif>17:30</option>
                <option value="17:45" @if($schedule->start_time === '17:45') selected @else @endif>17:45</option>

                <option value="18:00" @if($schedule->start_time === '18:00') selected @else @endif>18:00</option>
                <option value="18:15" @if($schedule->start_time === '18:15') selected @else @endif>18:15</option>
                <option value="18:30" @if($schedule->start_time === '18:30') selected @else @endif>18:30</option>
                <option value="18:45" @if($schedule->start_time === '18:45') selected @else @endif>18:45</option>

                <option value="19:00" @if($schedule->start_time === '19:00') selected @else @endif>19:00</option>
                <option value="19:15" @if($schedule->start_time === '19:15') selected @else @endif>19:15</option>
                <option value="19:30" @if($schedule->start_time === '19:30') selected @else @endif>19:30</option>
                <option value="19:45" @if($schedule->start_time === '19:45') selected @else @endif>19:45</option>

                <option value="20:00" @if($schedule->start_time === '20:00') selected @else @endif>20:00</option>
                <option value="20:15" @if($schedule->start_time === '20:15') selected @else @endif>20:15</option>
                <option value="20:30" @if($schedule->start_time === '20:30') selected @else @endif>20:30</option>
                <option value="20:45" @if($schedule->start_time === '20:45') selected @else @endif>20:45</option>

                <option value="21:00" @if($schedule->start_time === '21:00') selected @else @endif>21:00</option>
                <option value="21:15" @if($schedule->start_time === '21:15') selected @else @endif>21:15</option>
                <option value="21:30" @if($schedule->start_time === '21:30') selected @else @endif>21:30</option>
                <option value="21:45" @if($schedule->start_time === '21:45') selected @else @endif>21:45</option>

                <option value="22:00" @if($schedule->start_time === '22:00') selected @else @endif>22:00</option>
                <option value="22:15" @if($schedule->start_time === '22:15') selected @else @endif>22:15</option>
                <option value="22:30" @if($schedule->start_time === '22:30') selected @else @endif>22:30</option>
                <option value="22:45" @if($schedule->start_time === '22:45') selected @else @endif>22:45</option>

                <option value="23:00" @if($schedule->start_time === '23:00') selected @else @endif>23:00</option>
                <option value="23:15" @if($schedule->start_time === '23:15') selected @else @endif>23:15</option>
                <option value="23:30" @if($schedule->start_time === '23:30') selected @else @endif>23:30</option>
                <option value="23:45" @if($schedule->start_time === '23:45') selected @else @endif>23:45</option>
            </select>
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
            <button type="submit" class="btn btn-primary" id="button-edit-quiz">CẬP NHẬT</button>
          </div>
        </div>
      </fieldset>
    {{ Form::close() }}
</div>
@stop

@section('content')

@yield('create-quiz')

@stop
