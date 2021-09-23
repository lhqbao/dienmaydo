<?php
	if(isset($_GET['ma'])){
		$ma = $_GET['ma'];
		$a = mysqli_query($Connect,"select NSX_Ma, NSX_Ten from nhasanxuat where NSX_Ma = '$ma'");
		$row = mysqli_fetch_row($a);
		$MaNSX = $row[0];
		$TenNSX = $row[1];	
?>
<?php
	if(isset($_POST['btnCapNhat'])){
			$MaNSX  = $_POST['txtMaNSX'];
			$TenNSX = $_POST['txtTenNSX'];
			echo "<script>setTimeout(function(){CapNhatSanPham('nhasanxuat')},100);</script>";
			$b = "UPDATE nhasanxuat SET NSX_Ma = '$MaNSX',NSX_Ten = '$TenNSX' where NSX_Ma = '$ma'";
			mysqli_query($Connect,$b);
			
			}
?>
     <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
<div class="container">
	<h2>Cập nhật sản phẩm</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    <label for="txtMaNSX" class="col-sm-2 control-label">Mã Nhà Sản Xuất(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtMaNSX" id="txtTen" class="form-control" value='<?php echo $MaNSX; ?>'>
							</div>
					</div>
                    <div class="form-group">
						    <label for="txtTenNSX" class="col-sm-2 control-label">Tên Nhà Sản Xuất(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTenNSX" id="txtMoTa" class="form-control"value='<?php echo $TenNSX; ?>'>
							</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
                              <input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?ID=nhasanxuat'" />                              	
						</div>
					</div>
				</form>
	</div>
<?php
	}
else echo "<meta http-equiv='refresh' content='0; url=quanly_loaisanpham.php' />";;
?>