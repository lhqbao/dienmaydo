   <script>
    $(document).ready(function () {
      $('.demo').click(function (event) {
            // http://api.jquery.com/event.preventdefault/
            event.preventDefault();

             //save the url of the <a> tag that  was clicked.
             var url = $(this).attr("href");

             swal({
              title: "Bạn Có Chắc Muốn Xóa?",
              text: "Vui Lòng Xác Nhận Trước Khi Xóa!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Đồng Ý Xóa!",
              closeOnConfirm: false
            }, function (isConfirm) {
              if (isConfirm)
              {
                   //append a hidden frame and point it to the url of the <a> tag that was clicked.
                   $('<iframe src="'+url+'" style="position:absolute;left=-1000em;"></iframe>').appendTo('body');
                   swal({
                    title: "Xóa Thành Công",
                    type: "success"
                  }, function(){
                    setTimeout(function(){
                      window.location.href='?ID=loaisanpham';
                    },100);
                  }
                  );
                 }
                 else 
                 {
                  swal("Đã Hủy","","error"); 
                }
              });
           });
    });
    function XoaNhieu(event) {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
swal({
  title: "Bạn Có Chắc Xóa Không??",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Đồng Ý Xóa",
  cancelButtonText: "Cancel!",
  closeOnConfirm: true,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    form.submit();          // submitting the form when user press yes
  } else {
    swal("Hủy Bỏ","", "error");
  }
});
}
</script>
<!-- Bootstrap --> 
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<form name="frmXoa" method="post" action="?ID=quanly_xoanhieu_LSP">
  <h1>Danh sách loại sản phẩm</h1>
  <p>
   <a href="?ID=loaisanphamthemmoi"><span class="btn btn-primary">Thêm mới</span></a>
 </p>
 <table id="tablesalomon" class="table table-striped table-bordered text-justify" cellspacing="0" width="100%" >
  <thead>
    <tr>
     <th class="text-center"><strong>Chọn</strong></th>
     <th class="text-center"><strong>Số thứ tự</strong></th>
     <th class="text-center"><strong>Tên loại sản phẩm</strong></th>
     <th class="text-center"><strong>Mô tả</strong></th>
     <th class="text-center"><strong>Cập nhật</strong></th>
     <th class="text-center"><strong>Xóa</strong></th>
   </tr>
 </thead>

 <tbody>
  <?php
  $sql = mysqli_query($Connect,"Select * from loaisanpham");
  while($row = mysqli_fetch_array($sql))
  {
   ?>
   <tr>
     <td style="vertical-align: middle;"><input type="checkbox" name="checkbox[]" value="<?php echo $row['LSP_Ma']; ?>"/></td>
     <td style="vertical-align: middle;" width="7%"><?php echo $row['LSP_Ma']?></td>
     <td style="vertical-align: middle;" width="13%"><?php echo $row['LSP_Ten']; ?></td>
     <td style="vertical-align: middle;"><?php echo $row['LSP_MoTa']; ?></td>

     <td style="vertical-align: middle;" align='center' class='cotNutChucNang' width="7%">
      <a href="?ID=loaisanphamcapnhat&ma=<?php echo $row['LSP_Ma']; ?>">
        <img src='assets/img/update.png' width="20px" border='0'  /></a>
      </td>
      <td style="vertical-align: middle;" align='center' class='cotNutChucNang' width="5%">
        <a class="demo" href="?ID=loaisanpham&ma=<?php echo $row['LSP_Ma']; ?>">
          <img src='assets/img/delete.png' width="20px" border='0' /></a>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>  
<script language="javascript">
 function Delete(){
  if(confirm("Bạn Có Chắc Muốn Xóa Chứ!")){
   return true;
 }else return false;
}
</script>
<?php
if(isset($_GET['ma'])){
  $ma  =$_GET['ma'];
  mysqli_query($Connect,"DELETE from loaisanpham where LSP_Ma = '$ma'");
  echo "<meta http-equiv='refresh' content='0; url=?ID=loaisanpham'/>";
}
?>
<!--Nút Thêm mới , xóa tất cả-->
<div class="row"><!--Nút chức nang-->
  <div class="col-md-4">
    <input class="btn btn-primary" type="submit" name="btnXoaNhiu" onclick="XoaNhieu(event);" value="Xóa Các Mục Đã Chọn"/>
    <?php
					// if(isset($_POST['btnXoaNhiu']) && isset($_POST['checkbox']))
					// {
					// 	for($i = 0; $i < count($_POST['checkbox']); $i++)
					// 	{
					// 		$MaLoai = $_POST['checkbox'][$i];
					// 		mysqli_query($Connect,"DELETE from loaisanpham where LSP_Ma = '$MaLoai'");
					// 		echo "<meta http-equiv='refresh' content='0; url=?ID=loaisanpham'/>";
					// 	}
					// }
    ?>
  </div>
</div><!--Nút chức nang-->
</form>
