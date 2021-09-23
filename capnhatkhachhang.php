<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="assets/css/quantristyle.css">
</head>
<body>
	<div class="Profile">
		<!-- <div class="container"> -->
			<div class="Title text-center">
				<h1>Cập Nhật Thông Tin Tài Khoản</h1>
			</div>
			<div class="Info">
				<form method="post" action="">
					<table class="table table-bordered">
						<?php 
						if(isset($_GET['ma']))
						{
							$ID = $_GET['ma'];
							$Profile = mysqli_query($Connect,"SELECT * FROM khachhang WHERE KH_User = '$ID'");
							$rowProfile = mysqli_fetch_array($Profile);
						}
						?>
						<tr>
							<th width="15%" class="">Tên Tài Khoản: </th>
							<th><?php echo $rowProfile['KH_User'] ?></th>
						</tr>
						<tr>
							<th width="15%" class="-">Họ Và Tên: </th>
							<th><input class="form-control" type="text" name="txtHoten" value="<?php echo $rowProfile['KH_HoTen'] ?>"></th>
						</tr>
						<tr>
							<th width="15%" class="-">Địa Chỉ: </th>
							<th><input class="form-control" type="text" name="txtDiachi" value="<?php echo $rowProfile['KH_DiaChi'] ?>"></th>
						</tr>
						<tr>
							<th width="15%" class="-">Điện Thoại: </th>
							<th><input class="form-control" type="text" name="txtPhone" value="<?php echo $rowProfile['KH_DienThoai'] ?>"></th>
						</tr>
						<tr>
							<th width="15%" class="-">Địa Chỉ Mail: </th>
							<th><?php echo $rowProfile['KH_Email'] ?></th>
						</tr>
					</table>
					<div class="row">
						<div class="col-sm-6 text-right">
							<input style="    background: #d10024;
							color: white;
							border: none;
							width: 150px;
							height: 40px;
							border-radius: 1em;" type="submit" name="btnCapNhat" value="Cập Nhật">
						</div>
						<div class="col-sm-6">
							<input style="    background: #d10024;
							color: white;
							border: none;
							width: 150px;
							height: 40px;
							border-radius: 1em;" type="submit" name="btnBoQua" value="Bỏ Qua">
						</div>
					</div>
				</form>
			</div>
		<!-- </div> -->
	</div>
</body>
</html>
<?php 
if(isset($_POST['btnCapNhat']))
{
	$Hoten = $_POST['txtHoten'];
	$Diachi = $_POST['txtDiachi'];
	$Phone = $_POST['txtPhone'];
	if($Hoten == "" AND $Diachi == "" AND $Phone == "")
	{
		echo "Thông tin không được bỏ trống!";
	}
	else
	{
		mysqli_query($Connect,"UPDATE khachhang SET KH_HoTen = '".$Hoten."', KH_DiaChi = '".$Diachi."', KH_DienThoai = '".$Phone."' WHERE KH_User = '".$_SESSION['TaiKhoan']."'");
		echo "<script>setTimeout(function(){showSwalUpdateInfo('".$_SESSION['TaiKhoan']."')});</script>";
		//echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=capnhatkhachhang&ma=".$_SESSION['TaiKhoan']."'>";
	}
}
if(isset($_POST['btnBoQua']))
{
	echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=profile&ma=".$_SESSION['TaiKhoan']."'>";
}
?>