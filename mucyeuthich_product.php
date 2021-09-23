<?php 
function DatHang($IDSP,$Connect)
{
	$IDSP = $_GET['IDSP'];
	$SLHang = mysqli_query($Connect,"SELECT SP_SoLuong FROM sanpham WHERE SP_Ma = $IDSP");
	$RowSLHang = mysqli_fetch_row($SLHang);
	if($RowSLHang[0] >= 1)
	{
		$DaCo = false;
		foreach ($_SESSION['GioHang'] as $key => $row) {
			if($key == $IDSP)
			{
				$_SESSION['GioHang'][$key]['SoLuong'] += 1;
				$DaCo = true;
			}

		}
		if(!$DaCo)
		{
			$SPChiTiet = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten, c.LSP_Ma, NSX_Ten FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma JOIN nhasanxuat d ON a.NSX_Ma = d.NSX_Ma WHERE SP_Ma = '$IDSP'");
			$RowSPChiTiet = mysqli_fetch_array($SPChiTiet);
			$TenSP = $RowSPChiTiet['SP_Ten'];
			$GiaSP = $RowSPChiTiet['SP_GiaHienTai'];
			$Anh_SP = $RowSPChiTiet['AvatarSP'];
			$SoLuongSP = $RowSPChiTiet['SP_SoLuong'];
			$TenLSP = $RowSPChiTiet['LSP_Ten'];
			$TenNSX = $RowSPChiTiet['NSX_Ten'];
			$DatHang = array(
				"Ten" => $RowSPChiTiet['SP_Ten'],
				"Gia" => $RowSPChiTiet['SP_GiaHienTai'],
				"Anh_SP" => $RowSPChiTiet['AvatarSP'],
				"SoLuong" => 1,
				"Loai" => $RowSPChiTiet['LSP_Ten'],
				"NSX" => $RowSPChiTiet['NSX_Ten']);
			$_SESSION['GioHang'][$IDSP] = $DatHang;
		}
	}
}
if(isset($_GET['DatHang']) && isset($_GET['IDSP']))
{
	$IDSP = $_GET['IDSP'];
	DatHang($IDSP,$Connect);
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<h2 class="text-center" style="color: #D10024;">THÔNG TIN MỤC YÊU THÍCH</h2>
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
						<th class="text-center" style="vertical-align: middle;">Thêm Vào Giỏ Hàng</th>
					</tr>
					<?php 
					$Tong =0;
					if(isset($_SESSION['YeuThich']) && $_SESSION['YeuThich'] != NULL)
					{
						$stt=1;
						foreach ($_SESSION['YeuThich'] as $key => $item)
						{
							?>
							<tr>
								<td class="text-center" style="vertical-align: middle;"><?php echo $stt; ?></td>
								<td class="text-center" style="vertical-align: middle;"><?php echo $item['Ten']; ?></td>
								<td class="text-center" style="vertical-align: middle;"><img width="100px" src="img//Anh_SP/<?php echo $item['Anh_SP']; ?>"></td>
								<td class="text-center" style="vertical-align: middle;"><?php echo $item['NSX']; ?></td>
								<td class="text-center" style="vertical-align: middle;"><?php echo number_format($item['Gia'],0,",",".")." VNĐ"; ?></td>
								<td class="text-center" style="vertical-align: middle;"><a href="?DatHang=DatHang&xoayeuthich=xoayeuthich&IDSP=<?php echo $key; ?>" ><img width="30px" src="quantri/assets/img/add.png"></a></td>
							</tr>
							<?php
							$stt++;
						}
					}
					?>
				</table>
			</form>
		</div>
	</body>
	</html>
	<!-- <script type="text/javascript">
		function XoaDonHang()
		{
			if(confirm("Bạn Muốn Xóa Món Hàng Này?"))
			{
				return true;
			}
			else 
				return false;
		}
	</script> -->
	<?php
	/*if(isset($_GET['action']))
	{
		if($_GET['action'] == 'xoa')
		{
			$IDSP = $_GET['IDSP'];
			unset ($_SESSION['GioHang'][$IDSP]);
			echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=Giohang'/>";
		}
	}
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
						alert('Không Đủ Số Lượng Cung Cấp Quý Khách Vui Lòng Kiếm Tra Lại');
						</script>";
						echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=Giohang'/>";
					}
					else
					{
						echo "<script language='javascript'>
						alert('Bạn Vừa Cập Nhật Lại Số Lượng Vui Lòng Kiếm Tra Lại');
						</script>";
						echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=Giohang'/>";
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
			alert('Vui Lòng Đăng Nhập Trước Khi Thanh Toán');
			</script>";
			echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=dangnhap'/>";
		}
	}
	*/
	?>