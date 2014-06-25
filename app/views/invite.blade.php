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
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
        </div>
    </div>
@stop