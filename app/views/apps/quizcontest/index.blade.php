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
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Nội dung sự kiện</a></li>
      <li class=""><a href="#profile" data-toggle="tab">Code của bạn</a></li>
      <li class=""><a href="#rank" data-toggle="tab">Bảng xếp hạng</a></li>
    </ul>
    <div id='content-wrapper'>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <p>Deliver Us From Evil được dựa trên một câu chuyện có thật về Sĩ quan cảnh sát Ralph Sarchie và những hình ảnh hãi hùng về ác quỷ cứ xuất hiện và ám ảnh anh cùng gia đình bé nhỏ, với những vụ án kỳ lạ với những thủ pháp giết người ghê rợn liên tục trong thành phố. Sự việc dần được hé lộ khi Ralph Sarchie hợp tác cùng một pháp sư trừ tà Mendoza. Phim LINH HỒN BÁO THÙ - DELIVER US FROM EVIL khởi chiếu tại các rạp trên toàn quốc từ ngày 04/07/2014.</p>

            <p>Ngoài ra, Galaxy Thiên Ngân dành tặng các fan điện ảnh 3 thẻ quà tặng Galaxy Thiên Ngân có giá trị 200.000VND cho 3 bạn may mắn khi tham gia chương trình dưới đây:</p>

            <p><b>Mỗi ngày vào lúc 10PM từ 07/07 - 09/07, trên ứng dụng này sẽ xuất hiện 1 đoạn clip và 1 câu hỏi khác nhau, xem video và trả lời chính xác câu hỏi này, các bạn có cơ hội nhận được phần thưởng trên. Tham gia trả lời càng nhiều, càng tăng xác xuất nhận giải, vì vậy cập nhật chương trình thường xuyên các bạn nhé!</b></p>

            <p>(*) Kết quả chương trình sẽ được công bố tại ứng dụng này vào ngày 11/07/2014.</p>

            <div id="quiz-video">
            <iframe width="640" height="360" src="//www.youtube.com/embed/6DgrpB7wdy0?list=UUq_28uJmbq4tlji7YAMZGtg" frameborder="0" allowfullscreen></iframe>
            </div>

            <p>&nbsp;</p>
            <button id="button-invite" type="button" class="btn btn-default btn-lg btn-block">Gửi đáp án</button>
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