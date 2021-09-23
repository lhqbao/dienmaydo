<?php 
require('../connect.php');
require('../PHPExcel/Classes/PHPExcel.php');
if(isset($_POST['btnExport']))
{
     $OjExcel = new PHPExcel();
     //$OjExcel = PHPExcel_IOFactory::load('../PHPExcel/Classes/demo.xlsx');
     $OjExcel -> setActiveSheetIndex(0);//Tạo Tiêu đề cho bảng - tiêu đề ở vị trí 0
     $OjExcel -> getActiveSheet()->setTitle('DanhSachSanPham');
     $Sheet = $OjExcel->setActiveSheetIndex();
     $SoDong = 2;
     $Sheet -> setCellValue('A1','Mã Sản Phẩm');
     $Sheet -> setCellValue('B1','Tên Sản Phẩm');
     $Sheet -> setCellValue('C1','Giá Hiện Tại');
     $Sheet -> setCellValue('D1','Giá Cũ');
     $Sheet -> setCellValue('E1','Mô Tả');
     $Sheet -> setCellValue('F1','Mô Tả Chi Tiết');
     $Sheet -> setCellValue('G1','Ngày Cập Nhật');
     $Sheet -> setCellValue('H1','Số Lượng');
     $Sheet -> setCellValue('I1','Loại Sản Phẩm');
     $Sheet -> setCellValue('J1','Nhà Sản Xuất');
     $Sheet -> setCellValue('K1','Mã Khuyến Mãi');
     $Result = mysqli_query($Connect,"SELECT * FROM sanpham a JOIN loaisanpham b ON a.LSP_Ma = b.LSP_Ma JOIN nhasanxuat c ON a.NSX_Ma = c.NSX_Ma");
     while ($Row = mysqli_fetch_array($Result))
     {                      
     	$Sheet -> setCellValue('A'.$SoDong,$Row['SP_Ma']);
     	$Sheet -> setCellValue('B'.$SoDong,$Row['SP_Ten']);
     	$Sheet -> setCellValue('C'.$SoDong,$Row['SP_GiaHienTai']);
     	$Sheet -> setCellValue('D'.$SoDong,$Row['SP_GiaCu']);
     	$Sheet -> setCellValue('E'.$SoDong,$Row['SP_MoTa']);
     	$Sheet -> setCellValue('F'.$SoDong,$Row['SP_MoTa_ChiTiet']);
     	$Sheet -> setCellValue('G'.$SoDong,$Row['SP_NgayCapNhat']);
     	$Sheet -> setCellValue('H'.$SoDong,$Row['SP_SoLuong']);
     	$Sheet -> setCellValue('I'.$SoDong,$Row['LSP_Ten']);
     	$Sheet -> setCellValue('J'.$SoDong,$Row['NSX_Ten']);
     	$Sheet -> setCellValue('K'.$SoDong,$Row['KM_Ma']);
     	$SoDong++;
     }
     $Filename = 'SanPham.xlsx';
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