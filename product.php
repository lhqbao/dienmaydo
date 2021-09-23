
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Electro - Bán Đồ Công Nghệ</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel='stylesheet' href='sweetalert-master/sweet-alert.css'>

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<link type="text/css" rel="stylesheet" href="css/toan.css"/>
	<script src="js/jquery.min.js"></script>
	<script src='sweetalert-master/sweet-alert.min.js'></script>
	<script src='js/thongbao.js'></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		<?php 
		session_start();
		include_once('connect.php');
		if(!isset($_SESSION['GioHang']))
		{
			$_SESSION['GioHang'] = array();
		}
		if(!isset($_SESSION['YeuThich']))
		{
			$_SESSION['YeuThich'] = array();
		}
		?>
		<!-- Thêm Vào Yêu Thích -->
		<?php
		function YeuThich($IDSP,$Connect)
		{
			$IDSP = $_GET['IDSP'];
			$SLHang = mysqli_query($Connect,"SELECT SP_SoLuong FROM sanpham WHERE SP_Ma = $IDSP");
			$RowSLHang = mysqli_fetch_row($SLHang);
			if($RowSLHang[0] >= 1)
			{
				$DaThich = false;
				foreach ($_SESSION['YeuThich'] as $key => $row) {
					if($key == $IDSP)
					{
						$_SESSION['YeuThich'][$key]['SoLuong'] += 1;
						$DaThich = true;
					}

				}
				if(!$DaThich)
				{
					$SPChiTiet = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten, c.LSP_Ma, NSX_Ten FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma JOIN nhasanxuat d ON a.NSX_Ma = d.NSX_Ma WHERE SP_Ma = '$IDSP'");
					$RowSPChiTiet = mysqli_fetch_array($SPChiTiet);
			// $TenSP = $RowSPChiTiet['SP_Ten'];
			// $GiaSP = $RowSPChiTiet['SP_GiaHienTai'];
			// $SoLuongSP = $RowSPChiTiet['SP_SoLuong'];
			// $TenLSP = $RowSPChiTiet['LSP_Ten'];
			// $TenNSX = $RowSPChiTiet['NSX_Ten'];
			// $Anh_SP= $RowSPChiTiet['AvatarSP'];
					$YeuThich = array(
						"Ten" => $RowSPChiTiet['SP_Ten'],
						"Gia" => $RowSPChiTiet['SP_GiaHienTai'],
						"Anh_SP" => $RowSPChiTiet['AvatarSP'],
						"Loai" => $RowSPChiTiet['LSP_Ten'],
						"NSX" => $RowSPChiTiet['NSX_Ten']);
					$_SESSION['YeuThich'][$IDSP] = $YeuThich;
				}
				echo "<script language='javascript'>setTimeout(function(){AddFavoriteProduct('$IDSP')},100);</script>";
			}
		}
		if(isset($_GET['YeuThich']) && isset($_GET['IDSP']))
		{
			$IDSP = $_GET['IDSP'];
			YeuThich($IDSP,$Connect);
		}
		?>
		<!-- Thêm Vào Yêu Thích -->
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +84977-53-15-28</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> toanlh3@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Cần Thơ</a></li>
					</ul>
					<ul class="header-links pull-right">
						<?php
						if(isset($_SESSION['TaiKhoan']) && $_SESSION['QuanTri'] == 0)
						{
							?>
							<li><a href="?ID=myprofile&ma=<?php echo $_SESSION['TaiKhoan']; ?>"><i class="fa fa-user"></i> <?php echo "Chào: ".$_SESSION['TaiKhoan'] ; ?></a></li>
							<li><a href="?ID=dangxuat"><i class="fa fa-user-o"></i> Đăng Xuất</a></li>
							<?php 
						}
						else if(isset($_SESSION['TaiKhoan']) && $_SESSION['QuanTri'] == 1)
						{
							?>
							<li><a href="quantri/index.php"><i class="fa fa-cog"></i> Quản Trị</a></li>
							<li><a href="?ID=profile&ma=<?php echo $_SESSION['TaiKhoan']; ?>"><i class="fa fa-user"></i> <?php echo"Chào Quản Trị: ".$_SESSION['TaiKhoan']; ?></a></li>
							<li><a href="?ID=dangxuat"><i class="fa fa-sign-out"></i> Đăng Xuất</a></li>
							<?php 
						}
						else 
						{
							?>
							<li><a href="?ID=dangnhap"><i class="fa fa-user"></i> Đăng Nhập</a></li>
							<li><a href="?ID=dangky"><i class="fa fa-user-o"></i> Đăng Ký</a></li>
						</ul>
						<?php 
					}
					?>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="?ID=Timkiem" method="post">
									<select name="slLoaiSP" class="input-select">
										<option value='0'>Danh Mục Sản Phẩm</option>
										<?php 
										$SelectLSP = mysqli_query($Connect,"SELECT * FROM loaisanpham");
										while ($RowSelectLSP = mysqli_fetch_array($SelectLSP))
										{
											?>
											<option value="<?php echo $RowSelectLSP['LSP_Ma']; ?>"><?php echo $RowSelectLSP['LSP_Ten']; ?></option>
											<?php 
										}
										?>
									</select>
									<input name="txtSearch" class="input" placeholder="Nhập nội dung cần tìm ">
									<button name="btnSearch" type="submit" class="search-btn">Tìm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-heart-o"></i>
										<span>Yêu Thích</span>
										<div class="qty"><?php if(isset($_SESSION['YeuThich']) && count($_SESSION['YeuThich']) > 0) echo count($_SESSION['YeuThich']); else echo ''; ?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<?php 
											if(isset($_SESSION['YeuThich']) && $_SESSION['YeuThich'] != NULL)
											{
												foreach ($_SESSION['YeuThich'] as $key => $item) 
												{
													?>
													<div class="product-widget">
														<div class="product-img">
															<img src="img/Anh_SP/<?php echo $item['Anh_SP']; ?>" alt="">
														</div>
														<div class="product-body">
															<h3 class="product-name"><a href="?IDSP=<?php echo $key; ?>"><?php echo $item['Ten']; ?></a></h3>
															<h4 class="product-price"><?php echo number_format($item['Gia'],0,",",",")." VNĐ"; ?></h4>
														</div>
														<a class="XoaYeuThich" onclick="XoaComfirm(event,'XoaYeuThich')" href="?action=xoayeuthich&IDSP=<?php echo $key; ?>"><button class="delete"><i class="fa fa-close"></i></button></a>
													</div>
													<?php
												}
											}
											?>
										</div>
										<div class="cart-btns">
											<a style="width: 100%; background: #d31839;" href="?ID=Mucyeuthich">Xem Mục Yêu Thích</a>
										</div>
									</div>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ Hàng</span>
										<div class="qty"><?php if(isset($_SESSION['GioHang']) && count($_SESSION['GioHang']) > 0) echo count($_SESSION['GioHang']); else echo ''; ?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<?php 
											if(isset($_SESSION['GioHang']) && $_SESSION['GioHang'] != NULL)
											{
												foreach ($_SESSION['GioHang'] as $key => $itemGH) 
												{
													?>
													<div class="product-widget">
														<div class="product-img">
															<img src="img/Anh_SP/<?php echo $itemGH['Anh_SP']; ?>" alt="">
														</div>
														<div class="product-body">
															<h3 class="product-name"><a href="?IDSP=<?php echo $key; ?>"><?php echo $itemGH['Ten']; ?></a></h3>
															<h4 class="product-price"><span class="qty" style="color: red;  font-weight: bold;"><?php echo "X".$itemGH['SoLuong']; ?></span><?php echo number_format($itemGH['Gia'],0,",",",")." VNĐ"; ?></h4>
														</div>
														<a class="XoaSanPham" onclick="XoaComfirm(event,'XoaSanPham');" href="?action=xoa&IDSP=<?php echo $key; ?>"><button class="delete"><i class="fa fa-close"></i></button></a>
													</div>
													<?php
												}
											}
											?>
										</div>
										<div class="cart-summary">
											<small><?php if(isset($_SESSION['GioHang']) && count($_SESSION['GioHang']) > 0) echo count($_SESSION['GioHang']); else echo ''; ?> Item(s) được chọn</small>
											<h5 style="color: #D10024;">TỔNG TIỀN: 
												<?php  
												$Tong = 0;
												foreach ($_SESSION['GioHang'] as $key => $itemGH)
												{
													$Tong = $Tong + ($itemGH['SoLuong']*$itemGH['Gia']);
												}
												echo number_format($Tong,0,",",",")." VNĐ";
												?>
											</h5>
										</div>
										<div class="cart-btns">
											<a href="?ID=Giohang">Xem Giỏ Hàng</a>
											<a href="<?php if(isset($_SESSION['TaiKhoan'])){ echo "?ID=Thanhtoan"; } else echo "?ID=dangnhap";  ?>">Thanh Toán<i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<?php 
						$Menu = mysqli_query($Connect,"SELECT LSP_Ten,LSP_Ma FROM loaisanpham");
						while ($RowMenu = mysqli_fetch_array($Menu))
						{
							?>
							<li><a href="?ID=<?php if($RowMenu['LSP_Ma'] == 1){ echo 'Laptop'; } else if($RowMenu['LSP_Ma'] == 2){ echo 'Mayanh'; } else echo 'Dienthoai'; ?>"><?php echo $RowMenu['LSP_Ten']; ?></a></li>
							<?php 
						}
						?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<?php 
				if(isset($_GET['ID']))
				{
					$ID = $_GET['ID'];
					if($ID == 'dangnhap')
					{
						include_once('dangnhap.php');
					}
					else if($ID == 'dangky')
					{
						include_once('dangky.php');
					}
					else if($ID == 'dangxuat')
					{
						session_destroy();
						echo "<script>window.location='index.php';</script>";
					}
					else if($ID == 'product')
					{
						echo "<script>window.location='product.php'</script>";
					}
					else if($ID == 'Laptop')
					{
						include_once('sanpham_laptop.php');
					}
					else if($ID == 'Mayanh')
					{
						include_once('sannpham_mayanh.php');
					}
					else if($ID == 'Dienthoai')
					{
						include_once('sanpham_dienthoai.php');
					}
					else if($ID == 'Giohang')
					{
						include_once('giohang.php');
					}
					else if($ID == 'Thanhtoan')
					{
						include_once('thanhtoan.php');
					}
					else if($ID == 'Timkiem')
					{
						include_once('timkiem.php');
					}
					else if($ID == 'profile')
					{
						if(!isset($_SESSION['TaiKhoan'])){
							echo "<script language='javascript'>window.location='index.php';</script>";
						}
						else 
							include_once('quantri/myprofile.php');
					}
					else if($ID == 'capnhatkhachhang')
					{
						include_once('capnhatkhachhang.php');
					} 
					else if($ID == 'Mucyeuthich')
					{
						include_once('mucyeuthich.php');
					}
					else if($ID == 'index')
					{
						echo "<script language='javascript'>window.location='index.php';</script>";
					}
				}
				else 
				{
					include_once('chitietsanpham.php');
				}
				?>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<!-- NEWSLETTER -->
		<!-- <div Ma="newsletter" class="section">
			container
			<div class="container">
				row
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				/row
			</div>
			/container
		</div> -->
		<!-- SECTION -->
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Siêu thị điện máy Electro là một trong những siêu thị điện máy phát triển nhanh và ổn định bất chấp tình hình kinh tế thuận lợi hay khó khăn. Chuỗi siêu thị Salomon được thành lập từ 2018 chuyên bán lẻ các sản phẩm kỹ thuật số di động bao gồm điện thoại di động, máy tính bảng, laptop và phụ kiện.</p>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">PHÂN LOẠI</h3>
								<ul class="footer-links">
									<?php 
									$SelectLSP = mysqli_query($Connect,"SELECT * FROM loaisanpham");
									while ($RowSelectLSP = mysqli_fetch_array($SelectLSP))
									{
										?>
										<li><a href="?ID=<?php if($RowSelectLSP['LSP_Ma'] == 1)
										{ 
											echo "Laptop";
										}
										else if($RowSelectLSP['LSP_Ma'] == 2) 
										{
											echo "Mayanh";
										} 
										else 
										{
											echo "Dienthoai";
										}  ?>"><?php echo $RowSelectLSP['LSP_Ten']; ?></a></li>
										<?php 
									}
									?>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">NGƯỜI DÙNG</h3>
								<ul class="footer-links">
									<li><a href="?ID=profile&ma=<?php echo $_SESSION['TaiKhoan']; ?>">Tài Khoản</a></li>
									<li><a href="?ID=Giohang">Thông Tin Giỏ Hàng</a></li>
									<li><a href="?ID=Mucyeuthich">Mục Yêu Thích</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">LIÊN HỆ</h3>
								<ul class="footer-links">
									<li><a href="https://www.facebook.com/ongthanhtoan"><i class="fa fa-facebook"></i>Facebook</a></li>
									<li><a href="#"><i class="fa fa-map-marker"></i>Cần Thơ</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+84977-53-15-28</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>Toanlh3@email.com</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
		<!-- 		<script src="js/indexjs.js"></script> -->

	</body>
	</html>
	<script type="text/javascript">
		function XoaComfirm(event,Class)
		{
			event.preventDefault();
			var url = $('.'+Class).attr("href");
			swal({
				title: "Bạn Có Chắc Muốn Xóa?",
				text: "Vui Lòng Xác Nhận Trước Khi Xóa!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Đồng Ý Xóa!",
				closeOnConfirm: false
			},
			function(isConfirm)
			{
				if(isConfirm)
				{
					swal({
						title: "Xóa Thành Công",
						type: "success"
					},
					function()
					{
						setTimeout(function(){
							window.location.href=url;
						},100)
					});
				}
				else
				{
					swal({
						title: "Đã Hủy",
						type: "error"
					});
				}
			});
		}
	</script>
	<?php 
	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'xoa')
		{
			$IDSP = $_GET['IDSP'];
			unset ($_SESSION['GioHang'][$IDSP]);
			echo "<meta http-equiv = 'refresh' content = '0; URL=product.php?IDSP=$IDSP'/>";
		}
	}
	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'xoayeuthich')
		{
			$IDSP = $_GET['IDSP'];
			unset ($_SESSION['YeuThich'][$IDSP]);
			echo "<meta http-equiv = 'refresh' content = '0; URL=product.php?IDSP=$IDSP'/>";
		}
	}
	if(isset($_GET['action']))
	{
		if($_GET['xoayeuthich'] == 'xoayeuthich')
		{
			$IDSP = $_GET['IDSP'];
			unset ($_SESSION['YeuThich'][$IDSP]);
			echo "<script language='javascript'>setTimeout(function(){AddCart('Giohang')},100);</script>";
		}
	}
	?>
