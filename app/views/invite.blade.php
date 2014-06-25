@extends('master')

@section('content')
    <div class="banner-image"></div>

    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Nội dung sự kiện</a></li>
      <li class=""><a href="#profile" data-toggle="tab">Code của bạn</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <h3>Sự kiện: Mời ảo trúng thật</h3>
            <h4>Thể lệ:</h4>
            <p>- Invite App này với người thân, bạn bè. Với mỗi một invite bạn sẽ được tặng một code quay thưởng.</p>
            <h4>Hướng dẫn tham gia:</h4>
            <p>- Các bạn lựa chọn bạn bè từ danh sách bên dưới rồi ấn Invite, sau đó nhập lời nhắn và ấn gửi. Hệ thống sẽ tự động gửi cho bạn số code quay thưởng tương ứng </p>
            <select id="planets">
            </select>
            <script>

            </script>
            <p>&nbsp;</p>
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
    </div>
@stop