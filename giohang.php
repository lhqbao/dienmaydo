<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php 
	if(isset($_SESSION['GioHang']) && $_SESSION['GioHang'] != NULL)
	{
		?>
		<h2 class="text-center" style="color: #D10024;">THÔNG TIN GIỎ HÀNG</h2>
		<div class="Giohang">
			<div class="container">
				<form method="post" action="" name="form">
					<table class="table table-bordered" >
						<tr style="vertical-align: middle;">
							<th class="text-center" style="vertical-align: middle;">STT</th>
							<th class="text-center" style="vertical-align: middle;">Tên Sản Phẩm</th>
							<th class="text-center" style="vertical-align: middle;">Ảnh Sản Phẩm</th>
							<th class="text-center" style="width: 15%;">Nhà Sản Xuất</th>
							<th class="text-center" style="vertical-align: middle;">Giá Sản Phẩm</th>
							<th class="text-center" style="vertical-align: middle;">Số Lượng</th>
							<th class="text-center" style="vertical-align: middle;">Thành Tiền</th>
							<th class="text-center" style="vertical-align: middle;">Xóa</th>
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
									<td class="text-center" style="vertical-align: middle;"><input class="text-center" value="<?php echo $item['SoLuong']; ?>" style="width: 100px" type="number" name="SP_<?php echo $key; ?>"></td>
									<td class="text-center" style="vertical-align: middle;"><?php echo number_format($item['SoLuong']*$item['Gia'],0,",",".")." VNĐ"; ?></td>
									<td class="text-center XoaSanPham" style="vertical-align: middle;"><a onclick="XoaComfirm(event,'XoaSanPham');" href="?ID=Giohang&action=xoa&IDSP=<?php echo $key; ?>" ><img width="30px" src="quantri/assets/img/delete.png"></a></td>
								</tr>
								<?php
								$stt++;
								$Tong = $Tong + ($item['SoLuong']*$item['Gia']);
							}
						}
						?>
					</table>
					<h4 class="text-right">TỔNG TIỀN: <span style="color: red;"><?php echo number_format($Tong,0,",",".")." VNĐ"; ?></span>
					</h4>
					<div class="text-center"><input style="padding: 0 10px;
					background: #d10024;
					color: white;
					font-size: 20px;
					height:  50px;
					border:  none;
					border-radius: 1em;
					font-weight: bold;" type="submit" name="btnThanhToan" value="TIẾN HÀNH THANH TOÁN" id="Thanhtoan"></div>
				</form>
			</div>
			<?php
		}
		else 
		{
			?>
			<div class="container">
				<h3 class="text-center" style="color: #D10024;">KHÔNG CÓ MẶT HÀNG NÀO!</h3>
				<img style="margin-left: 465px;" align="center" src="img/cart-empty.png"><br>
				<a style="background: #D10024; border: none; font-size: 20px; margin-left: 490px; margin-bottom: 20px;" class="btn btn-primary" href="index.php">Mua Ngay Nào</a>
			</div>
			<?php
		}
		?>
	</div>
</body>
</html>
<?php 
if(isset($_POST['btnThanhToan']))
{
	if(isset($_SESSION['TaiKhoan']))
	{
		foreach ($_SESSION['GioHang'] as $key => $item)
		{
			if($_SESSION['GioHang'][$key]['SoLuong'] != $_POST['SP_'.$key])
			{
				$_SESSION['GioHang'][$key]['SoLuong'] = $_POST['SP_'.$key];
				$SLHang = mysqli_query($Connect,"SELECT SP_SoLuong FROM sanpham WHERE SP_Ma = $key");
				$RowSLHang = mysqli_fetch_array($SLHang);
				if($_POST['SP_'.$key] > $RowSLHang['SP_SoLuong'])
				{
					$_SESSION['GioHang'][$key]['SoLuong'] = 1;
					echo "<script language='javascript'>
					setTimeout(function(){swal({title: 'Thất Bại', text: 'Số Lượng Sản Phẩm Không Đủ, Vui Lòng Giảm Số Lượng!', type: 'error'});},100);
					</script>";
					break;
				}
				else
				{
					echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=Thanhtoan'/>";
				}
			}
			else
			{
				echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=Thanhtoan'/>";
			}
		}
	}
	else
	{
		echo "<script language='javascript'>
		setTimeout(function(){checkLogin()},100);
		</script>";
	}
}
?>