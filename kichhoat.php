<?php 
if(isset($_GET['User']) && isset($_GET['MaKH']))
{
	$User = $_GET['User'];
	$MaKH = $_GET['MaKH'];
	$Kiemtra = mysqli_query($Connect,"SELECT * FROM khachhang WHERE KH_User = '$User' AND KH_MaKichHoat = '$MaKH'");
	if(mysqli_num_rows($Kiemtra)>0)
	{
		mysqli_query($Connect,"UPDATE khachhang SET KH_TrangThai = 1 WHERE KH_User = '$User'");
		echo "<script language = 'javascript'>setTimeout(function(){activeSucess()},100);</script>";
	}
	else
	{
		echo "Mã Kích Hoạt Không Đúng";
	}
}
?>