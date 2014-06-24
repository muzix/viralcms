@extends('master')

@section('content')
	<h1>Danh sách khách hàng trúng thưởng</h1>
	<table cellpadding=2 cellspacing=2 border=0 width="850">
		<tr align=center> 
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">#</font></th>
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">FacebookID</font></th>
			<th bgcolor="#000033" style="width:200px"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Tên</font></th>
			<th bgcolor="#000033" style="width:150px"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Card</font></th>
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Voucher Name</font></th>
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Voucher Code</font></th>
			<th bgcolor="#000033"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Email</font></th>
			<th bgcolor="#000033" style="width:200px"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Thời gian</font></th>
		</tr>
	<?php $i=1 ?>
    @foreach($trackings as $tracking)
    	<tr bgcolor='#ffffff' align='center'>
    		<td><font size='2' face='Arial, Helvetica, sans-serif'><?php echo $i ?></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> {{ $tracking->spawned_item->user->fbid }} </font></td>
        	<td style=\"width:200px\"><font size='2' face='Arial, Helvetica, sans-serif'> <a href='http://facebook.com/{{$tracking->spawned_item->user->fbid}}'> {{ $tracking->spawned_item->user->shortname }} </a> </font></td>
        	<td style=\"width:150px\"><font size='2' face='Arial, Helvetica, sans-serif'> {{ $tracking->spawned_item->item->name }} </font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> @if($tracking->voucher !== null) {{ $tracking->voucher->name }} @endif</font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> @if($tracking->voucher !== null) {{ $tracking->voucher->code }} @endif</font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> {{ $tracking->spawned_item->user->email }} </font></td>
        	<td><font size='2' face='Arial, Helvetica, sans-serif'> {{ $tracking->item_found_at }} </font></td>
       	</tr>
       	<?php $i++ ?>
    @endforeach
	</table>
@stop
