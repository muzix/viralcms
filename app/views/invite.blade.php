@extends('master')

@section('content')
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
    <div class="banner-image"></div>
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Nội dung sự kiện</a></li>
      <li class=""><a href="#profile" data-toggle="tab">Code của bạn</a></li>
      <li class=""><a href="#rank" data-toggle="tab">Bảng xếp hạng</a></li>
    </ul>
    <div id='content-wrapper'>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <h3>GAME RỦ ẢO TRÚNG THẬT</h3>
            <h4>Thể lệ:</h4>
            <p>Trò chơi tặng vé xem phim miễn phí dành cho các fan của bộ phim kinh dị Deliver Us From Evil - Linh Hồn Báo Thù. Bạn có thể mời bạn bè đi xem phim cùng thông qua application RỦ ẢO TRÚNG THẬT của phim, mỗi lời mời xem phim bạn sẽ được thưởng một mã số may mắn.
            Mỗi người bạn rủ sẽ tương ứng với 1 mã số duy nhất, khi bạn mời nhiều lần 1 người thì mã số vẫn không thay đổi.
            </p>
            <p>Mã số may mắn này sẽ được công bố theo cơ cấu giải như sau:</p>
            <ul>
                <li>5 cặp vé xem phim cho 5 mã code may mắn mỗi tuần (đợt 1: ngày 4/7 và đợt 2: ngày 11/7)</li>
                <li>10 vé xem phim cho bạn nào mời được nhiều người bạn tới xem phim nhất tính đến ngày 6/7 (theo bảng xếp hạng)</li>
            </ul>

            <select id="planets">
            </select>

            <p>&nbsp;</p>
            <form id="form-invite" action="" method="post">
                {{Form::token()}}
                <input type="hidden" name="signedrequest" value="{{$signedRequest}}">
            </form>
            <button id="button-invite" type="button" class="btn btn-default btn-lg btn-block">Gửi lời mời</button>
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