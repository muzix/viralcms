@extends('master')

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
    <div class="banner-image"><img alt="Quiz Banner" width="800" src="/viralcms/public/assets/{{$quiz->banner}}" onerror="this.src = '/viralcms/public/assets/banner.png';"></img></div>
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
            <fieldset id='legend-youtube'>
              <legend>BƯỚC 1: XEM ĐOẠN VIDEO DƯỚI ĐÂY</legend>
              <div id="quiz-video">
                <iframe width="640" height="360" src="//www.youtube.com/embed/{{$youtube}}" frameborder="0" allowfullscreen></iframe>
              </div>
            </fieldset>
            <br/>
            {{ Form::open(array('route' => 'submitAnswer', 'class' => '', 'id' => 'form-answer')) }}
            <fieldset id='legend-info'>
              <legend>BƯỚC 2: ĐIỀN ĐẦY ĐỦ THÔNG TIN VÀO FORM SAU</legend>
              <div class="form-group required {{ $errors->has('fullname') ? 'has-error' : '' }}">
                <label for="fullname" class="col-lg-10 control-label">Họ tên</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ tên" value="{{Input::old('fullname')}}">
                  {{ Form::errorMsg('fullname') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="col-lg-10 control-label">Email</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{Input::old('email')}}">
                  {{ Form::errorMsg('email') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address" class="col-lg-10 control-label">Địa chỉ</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{Input::old('address')}}">
                  {{ Form::errorMsg('address') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone" class="col-lg-10 control-label">Điện thoại</label>
                <!-- <div class="col-lg-10"> -->
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại" value="{{Input::old('phone')}}">
                  {{ Form::errorMsg('phone') }}
                <!-- </div> -->
              </div>
              <div class="form-group required {{ $errors->has('answer') ? 'has-error' : '' }}">
                <label for="answer" class="col-lg-10 control-label">{{$question->question}}</label>
                <input type="text" class="form-control" id="answer" name="answer" placeholder="Trả lời" value="{{Input::old('answer')}}">
                {{ Form::errorMsg('answer') }}
              </div>
              <div class="form-group required">
                <!-- <label class="col-md-0 control-label">&#160;</label> -->
                <div class="col-md-7">

                  <div class="checkbox">
                    <label><input class="" id="term-accept" name="term-accept" type="checkbox" />
                      Tôi đã đọc và đồng ý với thể lệ & điều khoản của sự kiện</label>
                  </div>
                    {{ Form::errorMsg('term-accept') }}
                </div>

              </div>
            </fieldset>
            <input type="hidden" name="userId"  id="userId" value="{{$userId}}">
            <input type="hidden" name="questionId" id="questionId" value="{{$question->id}}">
            <div class="form-group">
              <div class="col-lg-offset-5">
                <button id="button-submit-answer" type="submit" class="btn btn-primary">Tham gia</button>
              </div>
            </div>
            {{ Form::close() }}

            <p>
              Những thông tin cá nhân người tham gia đang cung cấp cho Galaxy Thiên Ngân không phải Facebook. Những thông tin này sẽ được dùng cho mục đích duy nhất của chương trình tặng quà phim XYZ và Galaxy Thiên Ngân sẽ không tiết lộ bán hoặc chuyển nhượng cho bất kỳ đối tác nào khác.
            </p>
            <fieldset id='legend-term'>
              <legend>THỂ LỆ & ĐIỀU KHOẢN CHƯƠNG TRÌNH</legend>
              <ol>
                <li>Đối tượng tham gia: Dành cho tất cả các thành viên của Fanpage Galaxy Thiên Ngân.</li>
                <li><b>Thời gian công bố người thắng giải: ngày 20/07/2014</b></li>
                <li>Thành viên tham gia chương trình phải đồng ý với các điều khoản sau đây:
                  <ul>
                    <li>Người chiến thắng phải là thành viên (đã like) trang Fanpage và thực hiện đầy đủ yêu cầu của chương trình.</li>
                    <li>Galaxy Thiên Ngân sẽ không công nhận sự tham gia hợp lệ đến từ các tài khoản Facebook ảo của người chơi.</li>
                    <li>Người tham gia chịu trách nhiệm cung cấp thông tin theo Form yêu cầu chính xác. Những thông tin này để liên lạc với người thắng giải và làm thủ tục nhận quà tặng. Sự tham gia và dành giải từ các tài khoản có thông tin sai sẽ không được công nhận.</li>
                    <li>Người tham gia có thể trả lời nhiều câu hỏi trong thời gian diễn ra chương trình. Tuy nhiên mỗi người chơi chỉ nhận tối đa 1 giải thưởng</li>
                    <li>Trong trường hợp Galaxy không liên lạc được với người thắng giải nhiều lần <b>trước 05pm ngày XYZ</b> thì xem như đã từ chối nhận giải thưởng và do đó người thắng giải không được quyền khiếu nại, khiếu kiện và yêu cầu bồi thường. Giải thưởng sẽ được chuyển sang người thỏa điều kiện thắng giải tiếp theo</li>
                    <li>Khi tham gia chương trình nghĩa là người tham gia đã đọc kỹ và đồng ý với Thể lệ & Điều kiện của chương trinh. Mọi khiếu nại liên quan đễn những điều khoản trong Thể lệ & Điều kiện chương trình sẽ không được xử lý.</li>
                    <li>Hình thức chọn người thắng giải bốc thăm trúng thưởng trên những câu trả lời chính xác câu hỏi đặt ra.</li>
                    <li>Trong trường hợp có tranh chấp, quyết định của Galaxy Thiên Ngân là quyết định cuối cùng.</li>
                  </ul>
                </li>
              </ol>
            </fieldset>
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