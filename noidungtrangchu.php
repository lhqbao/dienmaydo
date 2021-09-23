<?php
function DatHang($IDSP,$Connect)
{
	$IDSP = $_GET['IDSP'];
	$SLHang = mysqli_query($Connect,"SELECT SP_SoLuong FROM sanpham WHERE SP_Ma = $IDSP");
	$RowSLHang = mysqli_fetch_row($SLHang);
	if($RowSLHang[0] >= 1)
	{
		$DaCo = false;
		foreach ($_SESSION['GioHang'] as $key => $row) {
			if($key == $IDSP)
			{
				$_SESSION['GioHang'][$key]['SoLuong'] += 1;
				$DaCo = true;
			}

		}
		if(!$DaCo)
		{
			$SPChiTiet = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten, c.LSP_Ma, NSX_Ten FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma JOIN nhasanxuat d ON a.NSX_Ma = d.NSX_Ma WHERE SP_Ma = '$IDSP'");
			$RowSPChiTiet = mysqli_fetch_array($SPChiTiet);
			$TenSP = $RowSPChiTiet['SP_Ten'];
			$GiaSP = $RowSPChiTiet['SP_GiaHienTai'];
			$Anh_SP = $RowSPChiTiet['AvatarSP'];
			$SoLuongSP = $RowSPChiTiet['SP_SoLuong'];
			$TenLSP = $RowSPChiTiet['LSP_Ten'];
			$TenNSX = $RowSPChiTiet['NSX_Ten'];
			$DatHang = array(
				"Ten" => $RowSPChiTiet['SP_Ten'],
				"Gia" => $RowSPChiTiet['SP_GiaHienTai'],
				"Anh_SP" => $RowSPChiTiet['AvatarSP'],
				"SoLuong" => 1,
				"Loai" => $RowSPChiTiet['LSP_Ten'],
				"NSX" => $RowSPChiTiet['NSX_Ten']);
			$_SESSION['GioHang'][$IDSP] = $DatHang;
		}
		echo "<script language='javascript'>setTimeout(function(){AddCart('index')},100);</script>";
	}
}
if(isset($_GET['DatHang']) && isset($_GET['IDSP']))
{
	$IDSP = $_GET['IDSP'];
	DatHang($IDSP,$Connect);
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
		echo "<script language='javascript'>setTimeout(function(){AddFavorite('index')},100);</script>";
	}
}
if(isset($_GET['YeuThich']) && isset($_GET['IDSP']))
{
	$IDSP = $_GET['IDSP'];
	YeuThich($IDSP,$Connect);
}
?>
<!-- Thêm Vào Yêu Thích -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="./img/product01.png"" alt="">
						</div>
						<div class="shop-body">
							<h3>Laptop</h3>
							<a href="?ID=Laptop" class="cta-btn">Mua Ngay <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="./img/product07.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Điện thoại thông minh</h3>
							<a href="?ID=Dienthoai" class="cta-btn">Mua Ngay <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="./img/flipup-canon-m3-600x600.jpg" alt="">
						</div>
						<div class="shop-body">
							<h3>Máy Ảnh</h3>
							<a href="?ID=Mayanh" class="cta-btn">Mua Ngay <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Sản Phẩm</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a href="?ID=Laptop">Laptops</a></li>
								<li><a href="?ID=Dienthoai">Điện Thoại Thông Minh</a></li>
								<li><a href="?ID=Mayanh">Máy Ảnh</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<!-- product -->
									<?php 
									$SanPham = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten, c.LSP_Ma FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma WHERE SP_SoLuong>0");
									while($RowSanPham = mysqli_fetch_array($SanPham))
									{
										?>
										<div class="product <?php if($RowSanPham['LSP_Ma'] == 1){ echo "Laptop"; } else if($RowSanPham['LSP_Ma'] == 2){ echo "Mayanh"; } else echo "Dienthoai"; ?>">
											<div class="product-img" >
												<img src="./img/Anh_SP/<?php echo $RowSanPham['AvatarSP']; ?>" alt="">
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $RowSanPham['LSP_Ten']; ?></p>
												<h3 class="product-name"><a href="product.php?IDSP=<?php echo $RowSanPham['SP_Ma']; ?>"><?php echo $RowSanPham['SP_Ten']; ?></a></h3>
												<h4 class="product-price"><?php echo number_format($RowSanPham['SP_GiaHienTai'],0,",",","."")." VNĐ";?><br><del class="product-old-price"><?php echo number_format($RowSanPham['SP_GiaCu'],0,",",","."")." VNĐ";?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button  class="add-to-wishlist"><a href="?YeuThich=YeuThich&IDSP=<?php echo $RowSanPham['SP_Ma']; ?>"><i class="fa fa-heart-o"></i></a><span class="tooltipp">Yêu Thích</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<a href="?DatHang=DatHang&IDSP=<?php echo $RowSanPham['SP_Ma']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</button></a>
											</div>
										</div>
										<?php 
									}
									?>
									<!-- /product -->
								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- HOT DEAL SECTION -->
	<div id="hot-deal" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="hot-deal">
						<!-- <ul class="hot-deal-countdown">
							<li>
								<div>
									<h3>02</h3>
									<span>Days</span>
								</div>
							</li>
							<li>
								<div>
									<h3>10</h3>
									<span>Hours</span>
								</div>
							</li>
							<li>
								<div>
									<h3>34</h3>
									<span>Mins</span>
								</div>
							</li>
							<li>
								<div>
									<h3>60</h3>
									<span>Secs</span>
								</div>
							</li>
						</ul> -->
						<h2 class="text-uppercase">hot deal this week</h2>
						<p>New Collection Up to 50% OFF</p>
						<!-- <a class="primary-btn cta-btn" href="#">Shop now</a> -->
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOT DEAL SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Bán Nhiều Nhất</h3>
						<!-- <div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
								<li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
								<li><a data-toggle="tab" href="#tab2">Cameras</a></li>
								<li><a data-toggle="tab" href="#tab2">Accessories</a></li>
							</ul>
						</div> -->
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab2" class="tab-pane fade in active">
								<div class="products-slick" data-nav="#slick-nav-2">
									<!-- product -->
									<?php 
									$SPBanChay = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten,(SELECT SUM(SP_DH_SoLuong) FROM sp_dondathang d WHERE a.SP_Ma = d.SP_Ma) AS SoLuong FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma ORDER BY SoLuong DESC LIMIT 0,4");
									while($RowSPBanChay = mysqli_fetch_array($SPBanChay))
									{
										?>
										<div class="product">
											<div class="product-img">
												<img src="./img/Anh_SP/<?php echo $RowSPBanChay['AvatarSP']; ?>" alt="">
												<div class="product-label">
													<span class="new">HOT</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $RowSPBanChay['LSP_Ten']; ?></p>
												<h3 class="product-name"><a href="product.php?IDSP=<?php echo $RowSPBanChay['SP_Ma']; ?>"><?php echo $RowSPBanChay['SP_Ten']; ?></a></h3>
												<h4 class="product-price"><?php echo number_format($RowSPBanChay['SP_GiaHienTai'],0,",",","."")." VNĐ";?><br><del class="product-old-price"><?php echo number_format($RowSPBanChay['SP_GiaCu'],0,",",","."")." VNĐ";?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button  class="add-to-wishlist"><a href="?YeuThich=YeuThich&IDSP=<?php echo $RowSPBanChay['SP_Ma']; ?>"><i class="fa fa-heart-o"></i></a><span class="tooltipp">Yêu Thích</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<a href="?DatHang=DatHang&IDSP=<?php echo $RowSPBanChay['SP_Ma']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</button></a>
											</div>
										</div>
										<?php 
									}
									?>
									<!-- /product -->
								</div>
								<div id="slick-nav-2" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- /Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">LapTop Bán Chạy Nhất</h4>
						<div class="section-nav">
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
					</div>
					<div class="products-widget-slick" data-nav="#slick-nav-3">
						<div>
							<!-- product widget -->
							<?php 
							$TopLapTop = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten,(SELECT SUM(SP_DH_SoLuong) FROM sp_dondathang d WHERE a.SP_Ma = d.SP_Ma) AS SoLuong FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma WHERE a.LSP_Ma = 1 ORDER BY SoLuong DESC LIMIT 0,3");
							while($RowTopLT = mysqli_fetch_array($TopLapTop))
							{
								?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/Anh_SP/<?php echo $RowTopLT['AvatarSP']; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $RowTopLT['LSP_Ten']; ?></p>
										<h3 class="product-name"><a href="product.php?IDSP=<?php echo $RowTopLT['SP_Ma']; ?>"><?php echo $RowTopLT['SP_Ten']; ?></a></h3>
										<h4 class="product-price"><?php echo number_format($RowTopLT['SP_GiaHienTai'],0,",",","."")." VNĐ";?><del class="product-old-price"><?php echo number_format($RowTopLT['SP_GiaCu'],0,",",","."")." VNĐ";?></del></h4>
									</div>
								</div>
								<?php 
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Máy Ảnh Bán Chạy Nhất</h4>
						<div class="section-nav">
							<div id="slick-nav-4" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-4">
						<div>
							<!-- product widget -->
							<?php 
							$TopCamera = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten,(SELECT SUM(SP_DH_SoLuong) FROM sp_dondathang d WHERE a.SP_Ma = d.SP_Ma) AS SoLuong FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma WHERE a.LSP_Ma = 2 ORDER BY SoLuong DESC LIMIT 0,3");
							while($RowTopCamera = mysqli_fetch_array($TopCamera))
							{
								?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/Anh_SP/<?php echo $RowTopCamera['AvatarSP']; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $RowTopCamera['LSP_Ten']; ?></p>
										<h3 class="product-name"><a href="product.php?IDSP=<?php echo $RowTopCamera['SP_Ma'];?>"><?php echo $RowTopCamera['SP_Ten']; ?></a></h3>
										<h4 class="product-price"><?php echo number_format($RowTopCamera['SP_GiaHienTai'],0,",",","."")." VNĐ";?><del class="product-old-price"><?php echo number_format($RowTopCamera['SP_GiaCu'],0,",",","."")." VNĐ";?></del></h4>
									</div>
								</div>
								<?php 
							}
							?>
							<!-- /product widget -->
						</div>
					</div>
				</div>

				<div class="clearfix visible-sm visible-xs"></div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Điện Thoại Bán Chạy Nhất</h4>
						<div class="section-nav">
							<div id="slick-nav-5" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-5">
						<div>
							<!-- product widget -->
							<?php 
							$TopPhone = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten,(SELECT SUM(SP_DH_SoLuong) FROM sp_dondathang d WHERE a.SP_Ma = d.SP_Ma) AS SoLuong FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma WHERE a.LSP_Ma = 3 ORDER BY SoLuong DESC LIMIT 0,3");
							while($RowTopPhone = mysqli_fetch_array($TopPhone))
							{
								?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/Anh_SP/<?php echo $RowTopPhone['AvatarSP']; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $RowTopPhone['LSP_Ten']; ?></p>
										<h3 class="product-name"><a href="product.php?IDSP=<?php echo $RowTopPhone['SP_Ma']; ?>"><?php echo $RowTopPhone['SP_Ten']; ?></a></h3>
										<h4 class="product-price"><?php echo number_format($RowTopPhone['SP_GiaHienTai'],0,",",","."")." VNĐ";?><del class="product-old-price"><?php echo number_format($RowTopPhone['SP_GiaCu'],0,",",","."")." VNĐ";?></del></h4>
									</div>
								</div>
								<?php 
							}
							?>
							<!-- /product widget -->
						</div>
					</div>
				</div>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
</body>
</html>