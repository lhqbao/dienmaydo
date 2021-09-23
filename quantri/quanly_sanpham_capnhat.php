<?php
function bindLSPList($Connect,$Value){
	$ListLSP = mysqli_query($Connect,"SELECT LSP_Ma, LSP_Ten from loaisanpham");
	echo "<select name='slLoaiSanPham' class='form-control'>";
	echo "<option value='0'>Chọn Loại Sản Phẩm</option>";
	while($row = mysqli_fetch_array($ListLSP)){
		if($row['LSP_Ma']==$Value){
			echo "<option value='".$row['LSP_Ma']."' selected>".$row['LSP_Ten']."</option>";
		}else echo "<option value='".$row['LSP_Ma']."'>".$row['LSP_Ten']."</option>";
	}
	echo "</select>";
}
function bindNSXList($Connect,$Value){
	$ListNSX = mysqli_query($Connect,"SELECT NSX_Ma, NSX_Ten from nhasanxuat");
	echo "<select name='slNhaSanXuat' class='form-control'>";
	echo "<option value='0'>Chọn Nhà Sản Xuất</option>";
	while($row = mysqli_fetch_array($ListNSX)){
		if($row['NSX_Ma']==$Value){
			echo "<option value='".$row['NSX_Ma']."' selected>".$row['NSX_Ten']."</option>";
		}else echo "<option value='".$row['NSX_Ma']."'>".$row['NSX_Ten']."</option>";
	}
	echo "</select>";
}
if(isset($_GET['ma'])){
	$Ma = $_GET['ma'];
	$sql = "select SP_Ten, LSP_Ma, NSX_Ma, SP_GiaHienTai, SP_MoTa, SP_MoTa_ChiTiet, SP_SoLuong from sanpham where SP_Ma='$Ma'";
	$result = mysqli_query($Connect,$sql);
	$row2 = mysqli_fetch_row($result);
	$TenSP = $row2[0];
	$LoaiSP = $row2[1];
	$NhaSX = $row2[2];
	$Gia = $row2[3];
	$MoTaNgan = $row2[4];
	$MoTaDai = $row2[5];
	$SL = $row2[6];
	?>
	<?php
	if(isset($_POST['btnCapNhat'])){
		$TenSP = $_POST['txtTen'];
		$LoaiSP = $_POST['slLoaiSanPham'];
		$NhaSX = $_POST['slNhaSanXuat'];
		$Gia = $_POST['txtGia'];
		$MoTaNgan = $_POST['txtMoTaNgan'];
		$MoTaDai = $_POST['txtMoTaChiTiet'];
		$SL = $_POST['txtSoLuong'];
		if(trim($TenSP=="")){
			echo "Vui Lòng Nhập Tên Sản Phẩm";
		}else if(!is_numeric($Gia)){
			echo "Nhập Giá Là Kiểu Số";
		}else if(!is_numeric($SL)){
			echo "Nhập SL Là Kiểu Số";
		}else if($LoaiSP==0){
			echo "Vui Lòng Chọn LSP";
		}else if($NhaSX==0){
			echo "Vui Lòng Chọn NSX";
		}else if($MoTaNgan==""){
			echo "Vui Lòng Nhập Mô Tả Ngắn";
		}else if($MoTaDai==""){
			echo "Vui Lòng Nhập Mô Tả Chỉ Tiết";
		}else {
			echo "<script>setTimeout(function(){CapNhatSanPham('sanpham')},100);</script>";
			mysqli_query($Connect,"UPDATE sanpham SET SP_Ten = '$TenSP', LSP_Ma = '$LoaiSP', NSX_Ma = '$NhaSX', SP_GiaHienTai = '$Gia', SP_MoTa = '$MoTaNgan', SP_MoTa_ChiTiet = '$MoTaDai', SP_SoLuong = '$SL' where SP_Ma = '$Ma'") or die(mysqli_error($Connect));
			
		}
	}
	?>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<div class="container">
		<h2>Cập nhật sản phẩm</h2>
		
		
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
			<div class="form-group">
				
				<label for="txtTen" class="col-sm-2 control-label">Tên sản phẩm(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên sản phẩm" value='<?php echo $TenSP; ?>'/>
				</div>
			</div>   
			<div class="form-group">   
				<label for="" class="col-sm-2 control-label">Loại sản phẩm(*):  </label>
				<div class="col-sm-10">
					<?php bindLSPList($Connect,$LoaiSP); ?>
				</div>
			</div>
			
			<div class="form-group">   
				<label for="" class="col-sm-2 control-label">Hãng sản xuất(*):  </label>
				<div class="col-sm-10">
					<?php bindNSXList($Connect,$NhaSX); ?>
				</div>
			</div>   
			<div class="form-group">  
				<label for="lblGia" class="col-sm-2 control-label">Giá(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtGia" id="txtGia" class="form-control" placeholder="Giá" value='<?php echo $Gia; ?>'/>
				</div>
			</div>   
			
			<div class="form-group">   
				<label for="lblMoTa_Ngan" class="col-sm-2 control-label">Mô tả ngắn(*):  </label>
				<div class="col-sm-10">
					<input type="text" name="txtMoTaNgan" id="txtMoTaNgan" class="form-control" placeholder="Mô tả ngắn" value='<?php echo $MoTaNgan; ?>'/>
				</div>
			</div>
			
			<div class="form-group">  
				<label for="lblMoTaChiTiet" class="col-sm-2 control-label">Mô tả chi tiết(*):  </label>
				<div class="col-sm-10">
					<textarea name="txtMoTaChiTiet" rows="4" class="form-control"><?php echo $MoTaDai; ?></textarea>
              <!--<script language="javascript">
                                        CKEDITOR.replace( 'txtMoTaChiTiet',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });
										
                                    </script> -->
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">  
                            	<label for="lblSoLuong" class="col-sm-2 control-label">Số lượng(*):  </label>
                            	<div class="col-sm-10">
                            		<input type="text" name="txtSoLuong" id="txtSoLuong" maxlength="10" id="txtGia" class="form-control" placeholder="Số lượng" value='<?php echo $SL; ?>'/>
                            	</div>
                            </div>
                            
                            
                            
                            
                            <div class="form-group">
                            	<div class="col-sm-offset-2 col-sm-10">
                            		<input type="submit"  class="btn btn-primary" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
                            		<input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?khoatrang=quanlysanpham'" />
                            		
                            	</div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                else header("Location:quanly_sanpham.php");
                ?>