<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="DoiPass">
		<!-- <div class="container"> -->
			<form action="" method="post">
				<h3 style="padding-top: 10px;" class="text-center">ĐỔI MẬT KHẨU</h3>
				<table align="center" class="table table-bordered" style="width: 50%;">
					<tr>
						<th width="30%" style="vertical-align: middle;">Mật Khậu Hiện Tại: </th>
						<td><input type="password" name="txtPassHienTai" class="form-control"></td>
					</tr>
					<tr>
						<th width="30%" style="vertical-align: middle;">Mật Khậu Mới: </th>
						<td><input type="password" name="txtPassMoi" class="form-control"></td>
					</tr>
				</table>
				<div class="row">
					<div class="col-sm-6 text-right">
						<input style="    background: #d10024;
						color: white;
						border: none;
						width: 150px;
						height: 40px;
						border-radius: 1em;" type="submit" name="btnDoiMatKhau" value="Đổi Mật Khẩu">
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
		<!-- </div> -->
	</div>
</body>
</html>
<?php 
if(isset($_POST['btnDoiMatKhau']))
{
	$PassHienTai = $_POST['txtPassHienTai'];
	$PassMoi = $_POST['txtPassMoi'];
	if($PassMoi == "" || strlen($PassMoi)<=5)
	{
		echo "<script>setTimeout(function(){showSwalChangePass_2()});</script>";
	}
	else
	{
		$Pass = mysqli_query($Connect,"SELECT KH_User, KH_Password FROM khachhang WHERE KH_User = '".$_SESSION['TaiKhoan']."'");
		$RowPass = mysqli_fetch_array($Pass);
		if(md5($PassHienTai) == $RowPass['KH_Password'])
		{	
			mysqli_query($Connect,"UPDATE khachhang SET KH_Password = '".md5($PassMoi)."' WHERE KH_User = '".$_SESSION['TaiKhoan']."'");
			echo "<script>setTimeout(function(){showSwalChangedPass('".$_SESSION['TaiKhoan']."')},100);</script>";
		}
		else 
		{
			echo "<script>setTimeout(function(){showSwalChangePassErorr_1()},100);</script>";
		}
	}
}
if(isset($_POST['btnBoQua']))
{
	echo "<meta http-equiv = 'refresh' content = '0; URL=?ID=profile&ma=".$_SESSION['TaiKhoan']."'>";
}
?>