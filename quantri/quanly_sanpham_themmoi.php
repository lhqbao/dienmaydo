	   <?php
	   function bindLSPList($Connect){
	   	$ListLSP = mysqli_query($Connect,"SELECT LSP_Ma, LSP_Ten from loaisanpham");
	   	echo "<select name='slLoaiSanPham' class='form-control'>";
	   	echo "<option value='0'>Chọn Loại Sản Phẩm</option>";
	   	while($row = mysqli_fetch_array($ListLSP)){
	   		echo "<option value='".$row['LSP_Ma']."'>".$row['LSP_Ten']."</option>";
	   	}
	   	echo "</select>";
	   }
	   function bindNSXList($Connect){
	   	$ListNSX = mysqli_query($Connect,"SELECT NSX_Ma, NSX_Ten from nhasanxuat");
	   	echo "<select name='slNhaSanXuat' class='form-control'>";
	   	echo "<option value='0'>Chọn Nhà Sản Xuất</option>";
	   	while($row = mysqli_fetch_array($ListNSX)){
	   		echo "<option value='".$row['NSX_Ma']."'>".$row['NSX_Ten']."</option>";
	   	}
	   	echo "</select>";
	   }
	   if(isset($_POST['btnThemMoi'])){
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
	   	}else if($TenSP != "" && $Gia != "" && $SL != "" && $LoaiSP != "" && $NhaSX != "" && $MoTaNgan != "" && $MoTaDai !=""){
	   		$sql = mysqli_query($Connect,"SELECT SP_Ten from sanpham where SP_Ten='$TenSP'");
	   		if(mysqli_num_rows($sql)==0){
	   			$Today=date('Y-m-d');
	   			mysqli_query($Connect,"INSERT INTO sanpham(SP_Ten, SP_GiaHienTai, SP_SoLuong, SP_MoTa, SP_MoTa_ChiTiet, LSP_Ma,NSX_Ma,SP_NgayCapNhat) VALUES('$TenSP','$Gia','$SL','$MoTaNgan','$MoTaDai','$LoaiSP','$NhaSX','$Today')") or die(mysqli_error($Connect));
	   			echo "<script>setTimeout(function(){SPThanhCong('sanpham')},100);</script>";
	   		}
	   		else if(mysqli_num_rows($sql)>0)
	   		{
	   			echo "<script>setTimeout(function(){SPCoRoi()},100);</script>";
	   		}
	   	}
	   }
	   ?>
	   <!-- Bootstrap -->
	   <link rel="stylesheet" href="css/bootstrap.min.css">
	   <!-- <div class="container"> -->
	   	<h2>Thêm sản phẩm</h2>

	   	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
	   		<div class="form-group">
	   			<label for="txtTen" class="col-sm-2 control-label">Tên sản phẩm(*):  </label>
	   			<div class="col-sm-10">
	   				<input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên loại sản phẩm" value=''/>
	   			</div>
	   		</div>   
	   		<div class="form-group">   
	   			<label for="" class="col-sm-2 control-label">Loại sản phẩm(*):  </label>
	   			<div class="col-sm-10">
	   				<?php bindLSPList($Connect) ?>
	   			</div>
	   		</div>

	   		<div class="form-group">   
	   			<label for="" class="col-sm-2 control-label">Hãng sản xuất(*):  </label>
	   			<div class="col-sm-10">
	   				<?php bindNSXList($Connect) ?>
	   			</div>
	   		</div>   

	   		<div class="form-group">  
	   			<label for="lblGia" class="col-sm-2 control-label">Giá(*):  </label>
	   			<div class="col-sm-10">
	   				<input type="text" name="txtGia" id="txtGia" class="form-control" placeholder="Giá" value=''/>
	   			</div>
	   		</div>   

	   		<div class="form-group">   
	   			<label for="lblMoTa_Ngan" class="col-sm-2 control-label">Mô tả ngắn(*):  </label>
	   			<div class="col-sm-10">
	   				<input type="text" name="txtMoTaNgan" id="txtMoTaNgan" class="form-control" placeholder="Mô tả ngắn" value=''/>
	   			</div>
	   		</div>

	   		<div class="form-group">  
	   			<label for="lblMoTaChiTiet" class="col-sm-2 control-label">Mô tả chi tiết(*):  </label>
	   			<div class="col-sm-10">
	   				<textarea name="txtMoTaChiTiet" rows="4" class="form-control"></textarea>
	   				<!-- <script language="javascript">
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
	   				<input type="text" name="txtSoLuong" id="txtSoLuong" maxlength="10" class="form-control" placeholder="Số lượng" value=""/>
	   			</div>
	   		</div>

	   		<div class="form-group">
	   			<div class="col-sm-offset-2 col-sm-10">
	   				<input type="submit"  class="btn btn-primary" name="btnThemMoi" id="btnThemMoi" value="Thêm mới"/>
	   				<input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?ID=sanpham'" />

	   			</div>
	   		</div>
	   	</form>
	   <!-- </div> -->
	   <script src="assets/vendor/jquery/jquery.min.js"></script>
	   <script src="../ckeditor/ckeditor.js"></script>