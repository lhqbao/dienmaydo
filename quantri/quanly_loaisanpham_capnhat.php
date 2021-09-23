<?php
if(isset($_GET['ma'])){
	$ma = $_GET['ma'];
	$a = mysqli_query($Connect,"select LSP_Ten, LSP_MoTa from loaisanpham where LSP_Ma = '$ma'");
	$row = mysqli_fetch_row($a);
	$ten = $row[0];
	$mota = $row[1];	
	?>
	<?php
	if(isset($_POST['btnCapNhat'])){
		$Ten  = $_POST['txtTen'];
		$MoTa = $_POST['txtMoTa'];
		echo "<script>setTimeout(function(){CapNhatSanPham('loaisanpham')},100);</script>";
		$b = "UPDATE loaisanpham SET LSP_Ten = '$Ten',LSP_MoTa = '$MoTa' where LSP_Ma = '$ma'";
		mysqli_query($Connect,$b);
	}
	?>
	<!-- Bootstrap --> 
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<div class="container">
		<h2>Cập nhật loại sản phẩm</h2>
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="txtTen" class="col-sm-2 control-label">Tên loại sản phẩm(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên loại sản phẩm" value='<?php echo $ten; ?>'>
				</div>
			</div>
			<div class="form-group">
				<label for="txtMoTa" class="col-sm-2 control-label">Mô tả(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtMoTa" id="txtMoTa" class="form-control" placeholder="Mô tả" value='<?php echo $mota; ?>'>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit"  class="btn btn-primary" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
					<input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='quanly_loaisanpham.php'" />                              	
				</div>
			</div>
		</form>
	</div>
	<?php
}
else echo "<meta http-equiv='refresh' content='0; url=?ID=sanpham' />";;
?>