
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Máy Ảnh</title>
</head>
<body>
	<div class="LapTop">
		<!-- <div class="container"> -->
			<div class="Title">
				<h1 class="text-center" style="color: #D10024; padding-top: 10px;">SẢN PHẨM MÁY ẢNH</h1>
			</div>
			<div class="DanhSachSanPham">
				<div class="SanPham">
					
					<div class="row">
						<?php 
						$SanPham = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma ORDER BY HSP_TenTapTin LIMIT 0,1) AS AvatarSP, LSP_Ten, c.LSP_Ma FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma WHERE c.LSP_Ma = 2");
						while($RowSanPham = mysqli_fetch_array($SanPham))
						{
							?>
							<div class="col-sm-4">
								<div class="product" style="margin-bottom: 60px;">
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
											<button class="add-to-wishlist"><a href="?YeuThich=YeuThich&IDSP=<?php echo $RowSanPham['SP_Ma']; ?>"><i style="font-size: 20px;" class="fa fa-heart-o"></i></a><span class="tooltipp">Yêu Thích</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<a href="?DatHang=DatHang&IDSP=<?php echo $RowSanPham['SP_Ma']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</button></a>
									</div>
								</div>
							</div>
							<?php 
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>