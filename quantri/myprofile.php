
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="assets/css/quantristyle.css">
</head>
<body>
	<div class="Profile">
<!-- 		<div class="container"> -->
			<div class="Title text-center">
				<h1>Thông Tin Tài Khoản</h1>
			</div>
			<div class="text-right">
				<a href="?ID=capnhatkhachhang&ma=<?php echo $_SESSION['TaiKhoan']; ?>"><div class="btn btn-primary" style="    background: #d10024;
				color: white;
				border: none;
				width: 350px;
				height: 40px;
				border-radius: 1em; line-height: 30px; font-size: 20px;">Cập nhật thông tin tài khoản</div></a>
				<a href="?ID=doimatkhau&ma=<?php echo $_SESSION['TaiKhoan']; ?>"><div class="btn btn-primary" style="    background: #d10024;
				color: white;
				border: none;
				width: 160px;
				height: 40px;
				border-radius: 1em; line-height: 30px; font-size: 20px; margin-right: 50px;">Đổi Mật Khẩu</div></a>
			</div>
			<p>&nbsp</p>
			<div class="Info">
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
						<th><?php echo $rowProfile['KH_HoTen'] ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Giới Tính: </th>
						<th><?php if($rowProfile['KH_GioiTinh'] == 1) echo "Nam"; else echo "Nữ"; ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Địa Chỉ: </th>
						<th><?php echo $rowProfile['KH_DiaChi'] ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Điện Thoại: </th>
						<th><?php echo $rowProfile['KH_DienThoai'] ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Địa Chỉ Mail: </th>
						<th><?php echo $rowProfile['KH_Email'] ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Năm Sinh: </th>
						<th><?php echo $rowProfile['KH_NgaySinh']."/".$rowProfile['KH_ThangSinh']."/".$rowProfile['KH_NamSinh']; ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Trạng Thái: </th>
						<th><?php if($rowProfile['KH_TrangThai'] == 1) echo "<font color='green'>Tài Khoản Hoạt Động</font>"; else echo "<font color='red'>Tài Khoản Không Hoạt Động</font>"; ?></th>
					</tr>
					<tr>
						<th width="15%" class="-">Quản Trị: </th>
						<th><?php if($rowProfile['KH_QuanTri'] == 1) echo "<font color='red'>Tài Khoản Admin</font>"; else echo "<font color='blue'>Tài Khoản Thường</font>" ?></th>
					</tr>
				</table>
			</div>
		<!-- </div> -->
	</div>
</body>
</html>