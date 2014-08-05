@extends('apps.quizcontest.master')

@section('css_tag')
<style>
div#wrapper {
    position:relative;
    margin-left:auto;
    margin-right:auto;
    padding-bottom:0;
    bottom:0;
    width:810px;
    background: transparent url('{{{url('/assets/'.$quiz->background)}}}') repeat !important;
}
</style>
@stop

@section('content')
    <!--
    <div class="modal" id="pleaseWaitDialog"  data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h1>Đang tải...</h1></div>
                    <div class="modal-body">
                        <div class="progress progress-striped active">
                            <div class="progress-bar" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->
    <div class="banner-image"><img alt="Quiz Banner" width="810" src="{{{url('/assets/'.$quiz->banner)}}}" onerror="this.src = '{{{url('/assets/banner.jpg')}}}';"></img></div>
    <!--
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Nội dung sự kiện</a></li>
      <li class=""><a href="#profile" data-toggle="tab">Code của bạn</a></li>
      <li class=""><a href="#rank" data-toggle="tab">Bảng xếp hạng</a></li>
    </ul>
  -->
    <div id='content-wrapper'>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            {{$quiz->description}}
            {{--<fieldset id='legend-youtube'>
              <legend>BƯỚC 1: XEM ĐOẠN VIDEO DƯỚI ĐÂY</legend>
              <div id="quiz-video">
                <iframe width="640" height="360" src="//www.youtube.com/embed/{{$youtube}}" frameborder="0" allowfullscreen></iframe>
              </div>
            </fieldset>--}}
            <br/>
            {{$youtube}}
            {{-- Form::open(array('route' => 'submitAnswer', 'class' => '', 'id' => 'form-answer')) --}}
            <div>
              <div class="form-group required {{ $errors->has('fullname') ? 'has-error' : '' }}">
                <label for="fullname" class="control-label">Họ tên</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ tên" value="{{Input::old('fullname')}}">
                  {{ Form::errorMsg('fullname') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{Input::old('email')}}">
                  {{ Form::errorMsg('email') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address" class="control-label">Địa chỉ</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{Input::old('address')}}">
                  {{ Form::errorMsg('address') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone" class="control-label">Điện thoại</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại" value="{{Input::old('phone')}}">
                  {{ Form::errorMsg('phone') }}
                <!-- </div> -->
              </div>
              <?php
                    $tmps = explode(':', $question->question);
               ?>
              @if(count($tmps) <= 1)
              <div class="form-group required {{ $errors->has('answer') ? 'has-error' : '' }}">
                <label for="answer" class="control-label">{{$question->question}}</label>
                <input type="text" class="form-control" id="answer" name="answer" placeholder="Trả lời" value="{{Input::old('answer')}}">
                {{ Form::errorMsg('answer') }}
              </div>
              @else
                <?php
                    //$tmps = explode(':', $question->question);
                    $options = explode(';', $tmps[1]);
                 ?>
                <div class="form-group required { $errors->has('answer') ? 'has-error' : '' }}">
                  <label class="control-label">{{$tmps[0]}}</label>
                  <div class="">
                    <?php
                        $sHTML = '';
                        $idx = 1;
                        $checked = "";
                        foreach ($options as $option) {
                            if ($option == Input::old('answer')) $checked = 'checked=""';
                            $sHTML = $sHTML.'<div class="radio"><label><input type="radio" name="answer" id="optionsRadios'.$idx.'" value="'.$option.'" '. $checked .'>'.$option.'</label></div>';
                            $idx++;
                            $checked = "";
                        }
                        echo $sHTML;
                    ?>
                  </div>
                  {{ Form::errorMsg('answer') }}
                </div>
              @endif
              <div class="form-group required">
                <label class="col-md-0 control-label"></label>
                <div class="col-lg-7">

                  <div class="checkbox">
                    <label><input class="" id="term-accept" name="term-accept" type="checkbox" />
                      Tôi đã đọc và đồng ý với thể lệ & điều khoản của sự kiện</label>
                  </div>
                    {{ Form::errorMsg('term-accept') }}
                </div>

              </div>

            <div class="form-group">
                <label class="control-label"></label>
                <div class="col-lg-7">
                 <button id="button-submit-answer-preview" class="btn btn-primary">Tham gia</button>
                </div>
            </div>
            <input type="hidden" name="userId"  id="userId" value="{{$userId}}">
            <input type="hidden" name="questionId" id="questionId" value="{{$question->id}}">
            {{-- Form::close() --}}
            <p>&nbsp;</p>
            <div class="form-group">
              <label class="control-label"></label>
              {{ $quiz->privacy }}
            </div>

            <div class="form-group">
              <label class="control-label"></label>
              {{ $quiz->term }}
            </div>
        </div>
        </div>
        <div class="tab-pane fade" id="profile">
            <table class="table table-striped table-hover " id="invitations">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Facebook nhận invite</th>
                  <th>Mã quay thưởng</th>
                  <th>Thời gian</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="rank">
            <table class="table table-striped table-hover " id="table-rank">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Thành viên</th>
                  <th>Số lời mời</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
        </div>
    </div>

    </div>
@stop