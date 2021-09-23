<?php
if(isset($_GET['ma'])){
	$ma = $_GET['ma'];
	$a = mysqli_query($Connect,"select KH_TrangThai, KH_QuanTri from khachhang where KH_User = '$ma'");
	$row = mysqli_fetch_row($a);
	$TrangThai = $row[0];
	$QuanTri = $row[1];	
	?>
	<?php
	if(isset($_POST['btnCapNhat'])){
		$TrangThai  = $_POST['txtTrangThai'];
		$QuanTri = $_POST['txtQuanTri'];
		$b = "UPDATE khachhang SET KH_TrangThai = '$TrangThai',KH_QuanTri = '$QuanTri' where KH_User = '$ma'";
		mysqli_query($Connect,$b);
		echo "<meta http-equiv='refresh' content='0; url=?ID=khachhang' />";
	}
	?>
	<!-- Bootstrap --> 
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<h2>Cập nhật thông tin</h2>
	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="txtTrangThai" class="col-sm-2 control-label">Trạng Thái Tài Khoảng(*):  </label>
			<div class="col-sm-10">
				<input type="text" name="txtTrangThai" id="txtTen" class="form-control" value='<?php echo $TrangThai; ?>'>
			</div>
		</div>
		<div class="form-group">
			<label for="txtQuanTri" class="col-sm-2 control-label">Trạng Thái Quản Trị(*):  </label>
			<div class="col-sm-10">
				<input type="text" name="txtQuanTri" id="txtMoTa" class="form-control"value='<?php echo $QuanTri; ?>'>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit"  class="btn btn-primary" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
				<input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?ID=khachhang'" />                              	
			</div>
		</div>
	</form>
	<h4 style="color: red;">Trạng Thái Tài Khoảng:</h4>
	<p>Trạng Thái 1: Tài Khoản Đang Hoạt Động.</p>
	<p>Trạng Thái 0: Tài Khoản Không Hoạt Động.</p>
	<h4 style="color: red;">Trạng Thái Quản Trị:</h4>
	<p>Trạng Thái 1: Tài Khoản Có Quyền Quản Trị.</p>
	<p>Trạng Thái 0: Tài Khoản Bình Thường.</p>
	<?php
}
else echo "<meta http-equiv='refresh' content='0; url=quanly_loaisanpham.php' />";;
?>