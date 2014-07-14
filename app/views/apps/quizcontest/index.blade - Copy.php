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
    <div class="banner-image"></div>
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
            <p>Deliver Us From Evil được dựa trên một câu chuyện có thật về Sĩ quan cảnh sát Ralph Sarchie và những hình ảnh hãi hùng về ác quỷ cứ xuất hiện và ám ảnh anh cùng gia đình bé nhỏ, với những vụ án kỳ lạ với những thủ pháp giết người ghê rợn liên tục trong thành phố. Sự việc dần được hé lộ khi Ralph Sarchie hợp tác cùng một pháp sư trừ tà Mendoza. Phim LINH HỒN BÁO THÙ - DELIVER US FROM EVIL khởi chiếu tại các rạp trên toàn quốc từ ngày 04/07/2014.</p>

            <p>Ngoài ra, Galaxy Thiên Ngân dành tặng các fan điện ảnh 3 thẻ quà tặng Galaxy Thiên Ngân có giá trị 200.000VND cho 3 bạn may mắn khi tham gia chương trình dưới đây:</p>

            <p><b>Mỗi ngày vào lúc 10PM từ 07/07 - 09/07, trên ứng dụng này sẽ xuất hiện 1 đoạn clip và 1 câu hỏi khác nhau, xem video và trả lời chính xác câu hỏi này, các bạn có cơ hội nhận được phần thưởng trên. Tham gia trả lời càng nhiều, càng tăng xác xuất nhận giải, vì vậy cập nhật chương trình thường xuyên các bạn nhé!</b></p>

            <p>(*) Kết quả chương trình sẽ được công bố tại ứng dụng này vào ngày 11/07/2014.</p>

            <fieldset id='legend-youtube'>
              <legend>BƯỚC 1: XEM ĐOẠN VIDEO DƯỚI ĐÂY</legend>
              <div id="quiz-video">
                <iframe width="640" height="360" src="//www.youtube.com/embed/6DgrpB7wdy0?list=UUq_28uJmbq4tlji7YAMZGtg" frameborder="0" allowfullscreen></iframe>
              </div>
            </fieldset>
            <br/>
            {{ Form::open(array('route' => 'submitAnswer', 'class' => 'form-horizontal', 'id' => 'form-answer')) }}
            <fieldset id='legend-answer'>
              <legend>BƯỚC 2: TRẢ LỜI CÂU HỎI SAU</legend>
              <div class="form-group required">
                <label for="answer" class="control-label">Ai đánh guitar trong video trên?</label>
                <input type="text" class="form-control" id="answer" name="answer" placeholder="Trả lời" value="">
              </div>
            </fieldset>
            <br/>
            <fieldset id='legend-info'>
              <legend>BƯỚC 3: ĐIỀN THÔNG TIN CỦA BẠN</legend>
              <div class="form-group required">
                <label for="fullname" class="col-lg-2 control-label">Họ tên</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ tên" value="">
                </div>
              </div>
              <div class="form-group required">
                <label for="email" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="">
                </div>
              </div>
              <div class="form-group required">
                <label for="phone" class="col-lg-2 control-label">Điện thoại</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại" value="">
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 control-label">&#160;</label>
                <div class="col-md-8">
                  <div class="checkbox">
                    <label><input class="" id="term-accept" name="term-accept" type="checkbox" /> 
                      Tôi đã đọc và đồng ý với thể lệ & điều khoản của sự kiện</label>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="form-group">
              <div class="col-lg-offset-5">
                <button id="button-invite" type="button" class="btn btn-primary">Gửi đáp án</button>
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