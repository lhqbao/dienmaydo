<?php 
require('../connect.php');
require('../PHPExcel/Classes/PHPExcel.php');
if(isset($_POST['btnExport']))
{
	$SoDong = 2;
	$OjExcel = new PHPExcel();
	$OjExcel -> setActiveSheetIndex(0);
	$OjExcel -> getActiveSheet() -> setTitle('DonHang');
	$Sheet = $OjExcel -> setActiveSheetIndex();
	$Sheet -> setCellValue('A1','Mã Đơn Hàng');
	$Sheet -> setCellValue('B1','Ngày Lập');
	$Sheet -> setCellValue('C1','Nơi Giao');
	$Sheet -> setCellValue('D1','Trạng Thái Thanh Toán');
	$Sheet -> setCellValue('E1','Hình Thức Thanh Toán');
	$Sheet -> setCellValue('F1','Tài Khoản Mua Hàng');
	$Result = mysqli_query($Connect,"SELECT * FROM donhang");
	while ($Row = mysqli_fetch_array($Result))
	{
		$TTTT = "";
		if($Row['DH_TrangThaiThanhToan'] == 0)
		{
			$TTTT = "Chưa Thanh Toán";
		} 
		else
		{
			$TTTT = "Đã Thanh Toán";
		}
		$HTTT = "";
		if($Row['HTTT_Ma'] == 1)
		{
			$HTTT = "Tiền Mặt";
		} 
		else if($Row['HTTT_Ma'] == 2)
		{
			$HTTT = "Chuyển Khoản";
		}
		else if($Row['HTTT_Ma'] == 3)
		{
			$HTTT = "PayPal";
		}
		$Sheet -> setCellValue('A'.$SoDong,$Row['DH_Ma']);
		$Sheet -> setCellValue('B'.$SoDong,$Row['DH_NgayLap']);
		$Sheet -> setCellValue('C'.$SoDong,$Row['DH_NoiGiao']);
		$Sheet -> setCellValue('D'.$SoDong,$TTTT);
		$Sheet -> setCellValue('E'.$SoDong,$HTTT);
		$Sheet -> setCellValue('F'.$SoDong,$Row['KH_User']);
		$SoDong++;
	}
	$Filename = 'DonHang.xlsx';
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