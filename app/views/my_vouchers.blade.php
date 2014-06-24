@extends('master')

@section('content')
	<?php $user = $vouchers[0]->user_tracking->spawned_item->user; ?>
	<h2>Danh sách phiếu thưởng của người chơi: <?php echo $user->shortname; ?></h2>
	<table cellpadding=0 cellspacing=0 border=0 width="100%">
		<tr align=center> 
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">#</font></th>
			<th bgcolor="#000033" style="width:150px"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Card</font></th>
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Voucher Name</font></th>
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Voucher Code</font></th>
			<th bgcolor="#000033" style="width:200px"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Thời gian</font></th>
		</tr>
	<?php $i=1 ?>
    @foreach($vouchers as $voucher)
    	<tr bgcolor='#ffffff' align='center'>
    		<td><font size='2' face='Arial, Helvetica, sans-serif'><?php echo $i ?></td>
        	<td style=\"width:150px\"><font size='2' face='Arial, Helvetica, sans-serif'> {{ $voucher->user_tracking->spawned_item->item->name }} </font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> {{ $voucher->name }} </font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> {{ $voucher->code }} </font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> {{ $voucher->user_tracking->item_found_at }} UTC</font></td>
       	</tr>
       	<?php $i++ ?>
    @endforeach
	
	</table>
	<?php $count = 0 ?>
    @foreach($special as $spec)
		<?php $count++ ?>
    @endforeach
    @if($count > 0)
    	<p>
    	Bạn rất may mắn! Bạn đã bắt được lá bài Electro #1 và nhận được 1 voucher đặc biệt từ hãng kem Swensen. Xin vui lòng đến Văn phòng của Galaxy tại TP.HCM hoặc Hà Nội để nhận thưởng. </p>
    @endif
	<br/>
    <strong>Địa chỉ liên hệ:</strong>
    <p>Tại Hà Nội: 
    <br/> Công ty Cổ phần Phim Thiên Ngân
	<br/> 16B Ngô Văn Sở, Hoàn Kiếm, Hà Nội
	<br/> ĐT: +84 43 974 6122
	</p>
	<p> Tại TP.Hồ Chí Minh:
 	<br/> 9/2 Tôn Đức Thắng, Phường Bến Nghé, Quận 1, TPHCM
	<br/> ĐT: +84 83 910 5619
    </p>
@stop