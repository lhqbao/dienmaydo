<?php 
require_once('../PHPExcel/Classes/PHPExcel.php');
if(isset($_POST['btnImport']))
{
	$File = $_FILES['file']['tmp_name'];
	if(is_file($File))
	{
		$OjReader = PHPExcel_IOFactory::createReaderForFile($File);

		$OjReader -> setLoadSheetsOnly('SanPham');

		$OjExcel = $OjReader -> load($File);

		$sheetData = $OjExcel -> getActiveSheet() -> toArray('null',true,true,true);

		$getSoDong = $OjExcel -> setActiveSheetIndex() -> getHighestRow();
		for($Row = 2; $Row <= $getSoDong; $Row++)
		{
			$Name = $sheetData[$Row]['A'];
			$GiaHienTai = $sheetData[$Row]['B'];
			$GiaCu = $sheetData[$Row]['C'];
			$MoTa = $sheetData[$Row]['D'];
			$MoTaChiTiet = $sheetData[$Row]['E'];
			$NgayUpdate = $sheetData[$Row]['F'];
			$SoLuong = $sheetData[$Row]['G'];
			$MaLSP = $sheetData[$Row]['H'];
			$MaNSX = $sheetData[$Row]['I'];
			$MaKM = $sheetData[$Row]['J'];
			mysqli_query($Connect,"INSERT INTO sanpham (SP_Ten, SP_GiaHienTai, SP_GiaCu, SP_MoTa, SP_MoTa_ChiTiet, SP_NgayCapNhat, SP_SoLuong, LSP_Ma, NSX_Ma, KM_Ma) VALUES('$Name', $GiaHienTai, $GiaCu, '$MoTa', '$MoTaChiTiet', '$NgayUpdate', $SoLuong, $MaLSP, $MaNSX, $MaKM)");
		}
		echo "<script language='javascript'>setTimeout(function(){SPThanhCong('sanpham')});</script>";
	}
	else
	{
		?>
		<script>
			setTimeout(function(){
				swal({
					title: 'Vui Lòng Chọn File Để Nhập',
					type: 'info'
				});
			},100);
		</script>
		<?php
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">

	<title>Document</title>

</head>
<body>

	<div class="Title">

		<h3 class="text-center">NHẬP DỮ LIỆU TỪ EXCEL VÀO DATABASE</h3>

	</div>

	<div class="Form container">

		<form action="" method="post" enctype="multipart/form-data">

			<span>Chọn Tập Tin: </span><input type="file" name="file">

			<input class="btnImport" type="submit" name="btnImport" value="IMPORT">

		</form>

	</div>

</body>
</html>
