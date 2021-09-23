<?php
if(isset($_POST['btnThemMoi'])){
	$ten = $_POST['txtTen'];
	$mota = $_POST['txtMoTa'];
	$loi ="";
	if($ten == ""){
		$loi.="<li>"."Vui Long Nhập Tên Loại Sản Phẩm"."</li>";
	}
	if($loi!=""){
		echo "<ul>.$loi.</ul>";
	}
	else {
		$sql = "select * from loaisanpham where LSP_Ten = '$ten'";
		$result = mysqli_query($Connect,$sql);
		if(mysqli_num_rows($result)==0){
			mysqli_query($Connect,"INSERT INTO loaisanpham(LSP_Ten,LSP_MoTa) VALUES('$ten','$mota')");
			echo "<script>setTimeout(function(){LSPThanhCong()},100);</script>";
		}
	}
}
?>
<!-- Bootstrap --> 
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- <div class="container"> -->
	<h2>Thêm loại sản phẩm</h2>
	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="txtTen" class="col-sm-2 control-label">Tên loại sản phẩm(*):  </label>
			<div class="col-sm-10">
				<input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên loại sản phẩm" value='<?php ?>'>
			</div>
		</div>
		
		<div class="form-group">
			<label for="txtMoTa" class="col-sm-2 control-label">Mô tả(*):  </label>
			<div class="col-sm-10">
				<input type="text" name="txtMoTa" id="txtMoTa" class="form-control" placeholder="Mô tả" value='<?php ?>'>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit"  class="btn btn-primary" name="btnThemMoi" id="btnThemMoi" value="Thêm mới"/>
				<input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?ID=loaisanpham'" />
				
			</div>
		</div>
	</form>
<!-- </div> -->