<?php
if(isset($_POST['btnThemMoi'])){
	$MaNSX = $_POST['txtMaNSX'];
	$TenNSX = $_POST['txtTenNSX'];
	$loi ="";
	if($TenNSX == ""){
		$loi.="<li>"."Vui Long Nhập Tên Nhà Sản Xuất"."</li>";
	}
	else if($MaNSX == ""){
		$loi.="<li>"."Vui Long Nhập Mã Nhà Sản Xuất"."</li>";
	}
	if($loi!=""){
		echo "<ul>.$loi.</ul>";
	}
	else {
		$sql = "select * from nhasanxuat where NSX_Ma = '$MaNSX' ORDER BY NSX_Ma";
		$result = mysqli_query($Connect,$sql);
		if(mysqli_num_rows($result)==0){
			mysqli_query($Connect,"INSERT INTO nhasanxuat(NSX_Ma,NSX_Ten) VALUES('$MaNSX','$TenNSX')");
			echo "<script>setTimeout(function(){SPThanhCong('nhasanxuat')},100);</script>";
		}
	}
}
?>
<!-- Bootstrap --> 
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- <div class="container"> -->
	<h2>Thêm nhà sản xuất</h2>
	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="txtMaNSX" class="col-sm-2 control-label">Mã Nhà Sản Xuất(*):  </label>
			<div class="col-sm-10">
				<input type="text" name="txtMaNSX" id="txtTen" class="form-control" placeholder="Tên loại sản phẩm" value='<?php ?>'>
			</div>
		</div>
		
		<div class="form-group">
			<label for="txtTenNSX" class="col-sm-2 control-label">Tên Nhà Sản Xuất(*):  </label>
			<div class="col-sm-10">
				<input type="text" name="txtTenNSX" id="txtMoTa" class="form-control" placeholder="Mô tả" value='<?php ?>'>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit"  class="btn btn-primary" name="btnThemMoi" id="btnThemMoi" value="Thêm mới"/>
				<input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?ID=nhasanxuat'" />
				
			</div>
		</div>
	</form>
	<!-- </div> -->