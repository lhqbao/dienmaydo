<?php 
require('../connect.php');
require('../PHPExcel/Classes/PHPExcel.php');
if(isset($_POST['btnExport']) && isset($_GET['MaDonHang']))
{
	$MaDonHang = $_GET['MaDonHang'];
	$SoDong = 2;
	$OjExcel = new PHPExcel();
	$OjExcel -> setActiveSheetIndex(0);
	$OjExcel -> getActiveSheet() -> setTitle('SanPhamDonHang');
	$Sheet = $OjExcel -> setActiveSheetIndex();
	$Sheet -> setCellValue('A1','Mã Đơn Hàng');
	$Sheet -> setCellValue('B1','Mã Sản Phẩm');
	$Sheet -> setCellValue('C1','Tên Sản Phẩm');
	$Sheet -> setCellValue('D1','Số Lượng');
	$Sheet -> setCellValue('E1','Giá');
	$Result = mysqli_query($Connect,"SELECT * FROM sp_dondathang a JOIN sanpham b ON a.SP_Ma = b.SP_Ma WHERE DH_Ma = $MaDonHang");
	while ($Row = mysqli_fetch_array($Result))
	{
		$Sheet -> setCellValue('A'.$SoDong,$Row['DH_Ma']);
		$Sheet -> setCellValue('B'.$SoDong,$Row['SP_Ma']);
		$Sheet -> setCellValue('C'.$SoDong,$Row['SP_Ten']);
		$Sheet -> setCellValue('D'.$SoDong,$Row['SP_DH_SoLuong']);
		$Sheet -> setCellValue('E'.$SoDong,$Row['SP_DH_DonGia']);
		$SoDong++;
	}
	$Filename = 'MaDonHang_'.$MaDonHang.'.xlsx';
	$OjWriter = new PHPExcel_Writer_Excel2007($OjExcel);
	$OjWriter -> save($Filename);
	header('Content-disposition: attachment; filename='.$Filename);
	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Length: ' . filesize($Filename));
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
     //ob_clean();
     //flush(); 
	readfile($Filename);
	return;
}
?>