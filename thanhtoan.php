<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<div class="Thanhtoan">
		<div class="container">
			<h2 class="text-center" style="color: #d10024;">NHẬP THÔNG TIN ĐỂ THANH TOÁN</h2>
			<div class="InfoThanhToan">
				<form action="" method="post">
					<table class="table table-bordered" >
						<tr style="vertical-align: middle;">
							<th class="text-center" style="vertical-align: middle;">STT</th>
							<th class="text-center" style="vertical-align: middle;">Tên Sản Phẩm</th>
							<th class="text-center" style="vertical-align: middle;">Ảnh Sản Phẩm</th>
							<th class="text-center" style="width: 15%;">Nhà Sản Xuất</th>
							<th class="text-center" style="vertical-align: middle;">Giá Sản Phẩm</th>
							<th class="text-center" style="vertical-align: middle;">Số Lượng</th>
							<th class="text-center" style="vertical-align: middle;">Thành Tiền</th>
						</tr>
						<?php 
						$Tong =0;
						if(isset($_SESSION['GioHang']) && $_SESSION['GioHang'] != NULL)
						{
							$stt=1;
							foreach ($_SESSION['GioHang'] as $key => $item)
							{
								?>
								<tr>
									<td class="text-center" style="vertical-align: middle;"><?php echo $stt; ?></td>
									<td class="text-center" style="vertical-align: middle;"><?php echo $item['Ten']; ?></td>
									<td class="text-center" style="vertical-align: middle;"><img width="100px" src="img//Anh_SP/<?php echo $item['Anh_SP']; ?>"></td>
									<td class="text-center" style="vertical-align: middle;"><?php echo $item['NSX']; ?></td>
									<td class="text-center" style="vertical-align: middle;"><?php echo number_format($item['Gia'],0,",",".")." VNĐ"; ?></td>
									<td class="text-center" style="vertical-align: middle;"><?php echo $item['SoLuong']; ?></td>
									<td class="text-center" style="vertical-align: middle;"><?php echo number_format($item['SoLuong']*$item['Gia'],0,",",".")." VNĐ"; ?></td>
								</tr>
								<?php
								$stt++;
								$Tong = $Tong + ($item['SoLuong']*$item['Gia']);
							}
						}
						?>
						<h4 class="text-right">TỔNG TIỀN: <span style="color: red;"><?php echo number_format($Tong,0,",",".")." VNĐ"; ?></span>
						</h4>
					</table>
					<table class="table table-bordered" width="100%">
						<tr>
							<th width="25%" style="vertical-align: middle;">Địa Chỉ Nhận Hàng(*): </th>
							<td><input class="form-control" type="text" name="txtDiaChiNhan"></td>
						</tr>
						<tr>
							<th width="25%" style="vertical-align: middle;">Chọn Hình Thức Thanh Toán(*): </th>
							<td><?php HTTT($Connect); ?></td>
						</tr>
					</table>
					<div class="row">
						<div class="col-md-6 text-right">
							<input style="background: #d10024; color: white; font-size: 20px; width: 200px; height: 50px; border: none;
							border-radius: 1em;" type="submit" name="btnGuiDonHang" value="Đặt Hàng">
						</div>
						<div class="col-md-6">
							<input style="background: #d10024; color: white; font-size: 20px; width: 200px; height: 50px; border: none;
							border-radius: 1em;" type="submit" name="btnXoaDonHang" value="Bỏ Qua">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php 
function HTTT($Connect)
{
	echo "<select name='slHTTT' class='form-control'>";
	echo "<option value='0'>Chọn Hình Thức Thanh Toán</option>";
	$HTTT = mysqli_query($Connect,"SELECT * FROM hinhthucthanhtoan");
	while($RowHTTT = mysqli_fetch_array($HTTT))
	{
		echo "<option value='".$RowHTTT['HTTT_Ma']."'>".$RowHTTT['HTTT_Ten']."</option>";
	}
	echo "</select>";
}
if(isset($_POST['btnGuiDonHang']))
{
	if($_POST['txtDiaChiNhan'] != "" && $_POST['slHTTT'] !=0)
	{
		$NoiGiao = $_POST['txtDiaChiNhan'];
		$HTTT = $_POST['slHTTT'];
		$NhapDonHang = mysqli_query($Connect,"INSERT INTO donhang (DH_NgayLap, DH_NoiGiao, DH_TrangThaiThanhToan, HTTT_Ma, KH_User) VALUES(now(),'".$NoiGiao."',0,'".$HTTT."','".$_SESSION['TaiKhoan']."')");
		$DH_Ma = mysqli_insert_id($Connect);
		foreach ($_SESSION['GioHang'] as $key => $item)
		{
			$SP_DatHang = mysqli_query($Connect,"INSERT INTO sp_dondathang(SP_Ma, DH_Ma, SP_DH_SoLuong, SP_DH_DonGia) VALUES('".$key."', '".$DH_Ma."', '".$item['SoLuong']."', '".$item['Gia']."')");
			$UpdateSoLuong = mysqli_query($Connect,"UPDATE sanpham SET SP_SoLuong = SP_SoLuong-'".$item['SoLuong']."' WHERE SP_Ma='".$key."'");
		}
		unset($_SESSION['GioHang']);
		echo "<script language='javascript'>
		setTimeout(function(){DatHang()},100);
		</script>";
	}
	echo "Vui Lòng Cập Nhật Đủ Thông Tin";
}
if(isset($_POST['btnXoaDonHang']))
{
	echo "<meta http-equiv = 'refresh' content ='0; URL=index.php'>";
}
?>