<head>
	<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
</head>
<script type="text/javascript">
	var RecaptchaOptions = {
		theme : 'white'
	};
</script>
<?php
//include("connect.php");
include_once("sendMail.php");
if(isset($_SESSION['TaiKhoan']))
{
	echo "<script language='javascript'>window.location='index.php';</script>";
}
$api_url = "https://www.google.com/recaptcha/api/siteverify";
$site_key = "6LeHzWMUAAAAAAJK4v-oDbMuXO0jPYUgLTVJ5MvD";
$secret_key = "6LeHzWMUAAAAAGPmu33FmSOBAokmWISHyDkFlCtU";
if(isset($_POST['btnDangKy'])){
	
	$loi ="";
 	// Lấy dữ liệu post lên
	$site_key_post = $_POST['g-recaptcha-response'];
 	// Lấy ip máy khách
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$remote_ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$remote_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$remote_ip = $_SERVER['REMOTE_ADDR'];
	}
 	// Tạo link kết nối
	$api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remote_ip;
 	// Lấy kết quá tra về từ google
	$response = file_get_contents($api_url);
 	// dữ liệu trả về dạng json
	$response = json_decode($response);
	if(!($response->success))
	{
		$loi.='<li>Captcha không đúng</li>';
	}
	$User = $_POST['txtTenDangNhap'];
	$Pass1 = $_POST['txtMatKhau1'];
	$Pass2 = $_POST['txtMatKhau2'];
	$HoTen = $_POST['txtHoTen'];
	$Email = $_POST['txtEmail'];
	$DiaChi = $_POST['txtDiaChi'];
	$DienThoai = $_POST['txtDienThoai'];
	if(isset($_POST['grpGioiTinh'])){
		$GT = $_POST['grpGioiTinh'];
	}
	$Ngay = $_POST['slNgaySinh'];
	$Thang = $_POST['slThangSinh'];
	$Nam = $_POST['slNamSinh'];
	$Loi = "";
	if($User==""){
		$Loi.="<p class='loi'>Vui Lòng Nhập Tên Đăng Nhập!</p>";
	}
	else if($User!=""){
		$User = $_POST['txtTenDangNhap'];
	}
	if($Pass1==""){
		$Loi.="<p class='loi'>Vui Lòng Nhập Mật Khẩu!</p>";
	}
	if($Pass2==""){
		$Loi.="<p class='loi'>Vui Lòng Nhập Lại Mật Khẩu!</p>";
	}
	if($Pass1!=$Pass2){
		$Loi.="<p class='loi'>Hai Mật Khẩu Phải Giống Nhau!</p>";
	}
	if(strlen($Pass1)<5){
		$Loi.="<p class='loi'>Mật Khẩu Phải Nhiều Hơn 5 Kí Tự!</p>";
	}
	if($HoTen==""){
		$Loi.="<p class='loi'>Vui Lòng Nhập Họ Và Tên!</p>";
	}
		/*if($Email==""){
			$Loi.="<li>Vui Lòng Nhập Địa Chỉ Email!</li>";
		}*/
		if(strpos($Email,"@")==false and $Email==""){
			$Loi.="<p class='loi'>Email Không Hợp Hệ</p>";
		}
		if($DiaChi==""){
			$Loi.="<p class='loi'>Vui Lòng Nhập Địa Chỉ!</p>";
		}
		if($DienThoai==""){
			$Loi.="<p class='loi'>Vui Lòng Nhập SĐT!</p>";
		}
		if(!isset($GT)){
			$Loi.="<p class='loi'>Vui Lòng Chọn Giới Tính!</p>";
		}
		if($Nam=="0"){
			$Loi.="<p class='loi'>Vui Lòng Chọn Năm Sinh!</p>";
		}
		if($Loi!=""){
			echo $Loi;
		}else 
		{	
			$Random = md5(rand());
			$CheckTKTrung = mysqli_query($Connect,"SELECT * FROM khachhang WHERE KH_User = '$User' OR KH_Email = '$Email'");
			if(mysqli_num_rows($CheckTKTrung) == 0)
			{
				$sql = "INSERT INTO khachhang(KH_User,KH_Password,KH_HoTen,KH_GioiTinh,KH_DiaChi,KH_DienThoai,KH_Email,KH_NgaySinh,KH_ThangSinh,KH_NamSinh,KH_MaKichHoat,KH_TrangThai,KH_QuanTri) VALUES('$User','".md5($Pass1)."','$HoTen','$GT','$DiaChi','$DienThoai','$Email','$Ngay','$Thang','$Nam','$Random',0,0)";
				mysqli_query($Connect,$sql);
				$NoiDungMail = "<p>Chúc mừng bạn đã đăng ký thành công</p>"."<p>Vui lòng nhấp vào liên kết sau để kích hoạt tài khoản <a href='http://localhost/Electro/index.php?ID=kichhoat&User=$User&MaKH=$Random'>http://localhost/Electro/kichhoat.php?User=$User&MaKH=$Random</a></p>";
				SendMail("toanlh3@gmail.com","bdsmvn2015","Ban Quản Trị Website",array(array($Email,$HoTen)),array(array("toanlh3@gmail.com","Ban Quản Trị Web")),"Mail Kích Hoạt",$NoiDungMail);
				echo "<script language='javascript'>setTimeout(function(){showSwalReg('$User')},100)</script>";
			}
			else
			{
				echo "<script language='javascript'>setTimeout(function(){showSwalRegError()},100);</script>";
			}
		}
	}
	?>
	<div class="container DangKy">
		<h2>Đăng ký thành viên</h2>
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
			<div class="form-group">

				<label for="txtTen" class="col-sm-2 control-label">Tên tài khoản(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtTenDangNhap" id="txtTenDangNhap" class="form-control" placeholder="Tên đăng nhập" value="<?php if(isset($User)){echo $User;}?>"/>
				</div>
			</div>  

			<div class="form-group">   
				<label for="" class="col-sm-2 control-label">Mật khẩu(*):  </label>
				<div class="col-sm-10">
					<input type="password" name="txtMatKhau1" id="txtMatKhau1" class="form-control" placeholder="Mật khẩu"/>
				</div>
			</div>     

			<div class="form-group"> 
				<label for="" class="col-sm-2 control-label">Nhập lại mật khẩu(*):  </label>
				<div class="col-sm-10">
					<input type="password" name="txtMatKhau2" id="txtMatKhau2" class="form-control" placeholder="Xác nhận mật khẩu"/>
				</div>
			</div>     

			<div class="form-group">                               
				<label for="lblHoten" class="col-sm-2 control-label">Họ tên(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtHoTen" id="txtHoTen" value="<?php if(isset($HoTen)){echo $HoTen;}?>" class="form-control" placeholder="Họ tên"/>
				</div>
			</div> 

			<div class="form-group">      
				<label for="lblEmail" class="col-sm-2 control-label">Email(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtEmail" id="txtEmail" value="<?php if(isset($Email)){echo $Email;}?>" class="form-control" placeholder="Email"/>
				</div>
			</div>  

			<div class="form-group">   
				<label for="lblDiaChi" class="col-sm-2 control-label">Địa chỉ(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtDiaChi" id="txtDiaChi" value="<?php if(isset($DiaChi)){echo $DiaChi;}?>" class="form-control" placeholder="Địa chỉ"/>
				</div>
			</div>  

			<div class="form-group">  
				<label for="lblDienThoai" class="col-sm-2 control-label">Điện thoại(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtDienThoai" id="txtDienThoai" value="<?php if(isset($DienThoai)){echo $DienThoai;}?>" class="form-control" placeholder="Điện thoại" />
				</div>
			</div> 

			<div class="form-group">  
				<label for="lblGioiTinh" class="col-sm-2 control-label">Giới tính(*):  </label>
				<div class="col-sm-10">                              
					<label class="radio-inline"><input type="radio" name="grpGioiTinh" value="0" id="grpGioiTinh" <?php if(isset($GioiTinh)&&$GioiTinh=="0"){echo "checked";}?>/>Nam</label>

					<label class="radio-inline"><input type="radio" name="grpGioiTinh" value="1" id="grpGioiTinh" <?php if(isset($GioiTinh)&&$GioiTinh=="1"){echo "checked";}?>/>Nữ</label>

				</div>
			</div> 

			<div class="form-group"> 
				<label for="lblNgaySinh" class="col-sm-2 control-label">Ngày sinh(*):  </label>
				<div class="col-sm-10 input-group">
					<span class="input-group-btn">
						<select name="slNgaySinh" id="slNgaySinh" class="form-control"">
							<option value="0">Chọn ngày</option>
							<?php
							for($i=1;$i<=31;$i++)
							{
								if($i==$ngaysinh){
									echo "<option class='form-control' value='".$i."' selected=\"selected\">".$i."</option>";
								}
								else{
									echo "<option class='form-control' value='".$i."'>".$i."</option>";
								}
							}
							?>
						</select>
					</span>
					<span class="input-group-btn">
						<select name="slThangSinh" id="slThangSinh" class="form-control">
							<option value="0">Chọn tháng</option>
							<?php
							for($i=1;$i<=12;$i++)
							{
								if($i==$thangsinh){
									echo "<option value='".$i."' selected=\"selected\">".$i."</option>";
								}
								else{
									echo "<option value='".$i."'>".$i."</option>";
								}
							}
							?>
						</select>
					</span>
					<span class="input-group-btn">
						<select name="slNamSinh" id="slNamSinh" class="form-control">
							<option value="0">Chọn năm</option>
							<?php
							for($i=1970;$i<=2018;$i++)
							{
								if($i==$namsinh){
									echo "<option value='".$i."' selected=\"selected\">".$i."</option>";
								}
								else{
									echo "<option value='".$i."'>".$i."</option>";
								}
							}
							?>
						</select>
					</span>
				</div>
			</div>	
			<div class="form-group">
				<label for="lbMaAnToan" class="col-sm-2 control-label">Mã An Toàn:</label>
				<div class="col-sm-10">
					<div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10 Nut text-center">
					<input type="submit"  class="btn btn-primary" name="btnDangKy" id="btnDangKy" value="Đăng ký" style="width: 500px; font-size: 20px;" />
				</div>
			</div>
		</form>
	</div>
	


