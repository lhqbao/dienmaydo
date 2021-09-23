<!-- SECTION -->
<?php 
if(isset($_GET['IDSP']))
{
	$IDSP = $_GET['IDSP'];
	if(isset($_POST['btnDatHang']))
	{
		if(is_numeric($_POST['SoLuong']))
		{
			$SLHang = mysqli_query($Connect,"SELECT SP_SoLuong FROM sanpham WHERE SP_Ma = $IDSP");
			$RowSLHang = mysqli_fetch_row($SLHang);
			if($RowSLHang[0] >= $_POST['SoLuong'])
			{
				$DaCo = false;
				foreach ($_SESSION['GioHang'] as $key => $row) {
					if($key == $IDSP)
					{
						$_SESSION['GioHang'][$key]['SoLuong'] += $_POST['SoLuong'];
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
						"SoLuong" => $_POST['SoLuong'],
						"Loai" => $RowSPChiTiet['LSP_Ten'],
						"NSX" => $RowSPChiTiet['NSX_Ten']);
					$_SESSION['GioHang'][$IDSP] = $DatHang;
				}
				echo "<script language='javascript'>setTimeout(function(){AddCartProduct('$IDSP')},100);</script>";
			}
			else 
			{
				echo "<script language='javascript'>
				setTimeout(function(){AddFavoriteProduct_Error('$IDSP')},100);
				</script>";
			}
		}
	}
	?>
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- Product main img -->
				<div class="col-md-5 col-md-push-2">
					<div id="product-main-img">
						<?php 
						$AnhMain = mysqli_query($Connect,"SELECT HSP_TenTapTin FROM hinhsanpham WHERE SP_Ma = '$IDSP'");
						while($RowAnhMain = mysqli_fetch_array($AnhMain))
						{
							?>
							<div class="product-preview">
								<img src="img/Anh_SP/<?php echo $RowAnhMain['HSP_TenTapTin']; ?>" alt="">
							</div>
							<?php 
						}
						?>
					</div>
				</div>
				<!-- /Product main img -->
				<!-- Product thumb imgs -->
				<div class="col-md-2  col-md-pull-5">
					<div id="product-imgs">
						<?php 
						$AnhMain = mysqli_query($Connect,"SELECT HSP_TenTapTin FROM hinhsanpham WHERE SP_Ma = '$IDSP'");
						while($RowAnhMain = mysqli_fetch_array($AnhMain))
						{
							?>
							<div class="product-preview">
								<img src="img/Anh_SP/<?php echo $RowAnhMain['HSP_TenTapTin']; ?>" alt="">
							</div>
							<?php 
						}
						?>
					</div>
				</div>
				<!-- /Product thumb imgs -->

				<!-- Product details -->
				<div class="col-md-5">
					<?php 
					$SPChiTiet = mysqli_query($Connect,"SELECT SP_Ma, LSP_Ten, a.LSP_Ma, NSX_Ten, SP_Ten, SP_GiaHienTai, SP_GiaCu, SP_MoTa, SP_MoTa_ChiTiet, SP_SoLuong FROM sanpham a JOIN loaisanpham b ON a.LSP_Ma = b.LSP_Ma JOIN nhasanxuat c ON a.NSX_Ma = c.NSX_Ma WHERE SP_Ma = '$IDSP'");
					while($RowSPChiTiet = mysqli_fetch_array($SPChiTiet))
					{
						?>
						<div class="product-details">
							<h2 class="product-name"><?php echo $RowSPChiTiet['SP_Ten']; ?></h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>

							</div>
							<div>
								<h3 class="product-price"><?php echo number_format($RowSPChiTiet['SP_GiaHienTai'],0,",",","."")." VNĐ"; ?><del class="product-old-price"><?php echo number_format($RowSPChiTiet['SP_GiaCu'],0,",",","."")." VNĐ"; ?></del></h3>
								<span class="product-available"><?php if($RowSPChiTiet['SP_SoLuong']<=0){ echo "<font color='black'>Hết Hàng</font>";} else echo "Còn Hàng"; ?></span>
							</div>
							<p><?php echo $RowSPChiTiet['SP_MoTa']; ?></p>
							<div class="add-to-cart">
								<div class="qty-label">
									Số Lượng:
									<div class="input-number">
										<form name="frmDatHang" id="frmDatHang" method="post" action="">
											<input name="SoLuong" type="number" value="1">
											<span class="qty-up">+</span>
											<span class="qty-down">-</span>

										</div>
									</div>
									<button name="btnDatHang" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</button>
								</form>
							</div>

							<ul class="product-btns">
								<li><a href="?YeuThich=YeuThich&IDSP=<?php echo $RowSPChiTiet['SP_Ma']; ?>"><i class="fa fa-heart-o"></i> thêm vào yêu thích</a></li>
							</ul>

							<ul class="product-links">
								<li>Loại: </li>
								<li><a href="?ID=<?php if($RowSPChiTiet['LSP_Ma'] == 1){ echo "Laptop"; } else if($RowSPChiTiet['LSP_Ma'] == 2){ echo "Mayanh"; } else echo "Dienthoai"; ?>"><?php echo $RowSPChiTiet['LSP_Ten']; ?></a></li>
								<li>Nhà Sản Xuất: </li>
								<li><a href="?ID=<?php if($RowSPChiTiet['LSP_Ma'] == 1){ echo "Laptop"; } else if($RowSPChiTiet['LSP_Ma'] == 2){ echo "Mayanh"; } else echo "Dienthoai"; ?>"><?php echo $RowSPChiTiet['NSX_Ten']; ?></a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Mô Tả</a></li>
								<li><a data-toggle="tab" href="#tab2">Chi Tiết Sản Phẩm</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p style="font-size: 17px;"><?php echo $RowSPChiTiet['SP_MoTa']; ?></p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p style="font-size: 17px;">
												<?php
												$ChiTietSanPham = explode(",",$RowSPChiTiet['SP_MoTa_ChiTiet']); 
												foreach ($ChiTietSanPham as $key => $value) {
													echo $value."</br>";
												}
												?>
											</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->
								<?php 
							}
							?>
						</div>
						<!-- /product tab content  -->
					</div>
				</div>
				<!-- /product tab -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<?php
}
?>
			<!-- /SECTION -->