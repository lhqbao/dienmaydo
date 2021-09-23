<script>
// import jquery and the plugin first
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
                      window.location.href='?ID=nhasanxuat';
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
<form name="frmXoa" method="post" action="?ID=quanly_xoanhieu_NSX">
  <h1>Danh sách nhà sản xuất</h1>
  <p>
   <a href="?ID=nhasanxuatthemmoi"><span class="btn btn-primary">Thêm mới</span></a>
 </p>
 <table id="tablesalomon" class="table table-striped table-bordered text-justify" cellspacing="0" width="100%" >
  <thead>
    <tr>
     <th class="text-center"><strong>Chọn</strong></th>
     <th class="text-center"><strong>Mã Nhà Sản Xuất</strong></th>
     <th class="text-center"><strong>Tên Nhà Sản Xuất</strong></th>
     <th class="text-center"><strong>Cập nhật</strong></th>
     <th class="text-center"><strong>Xóa</strong></th>
   </tr>
 </thead>

 <tbody>
  <?php
  $sql = mysqli_query($Connect,"Select * from nhasanxuat");
  while($row = mysqli_fetch_array($sql))
  {
   ?>
   <tr>
     <td ><input type="checkbox" name="checkbox[]" value="<?php echo $row['NSX_Ma']; ?>"/></td>
     <td ><?php echo $row['NSX_Ma']?></td>
     <td ><?php echo $row['NSX_Ten']; ?></td>
     <td  align='center' class='cotNutChucNang' width="7%">
      <a href="?ID=nhasanxuatcapnhat&ma=<?php echo $row['NSX_Ma']; ?>">
        <img src='assets/img/update.png' width="20px" border='0'  /></a>
      </td>
      <td  align='center' class='cotNutChucNang' width="5%">
        <a href="?ID=nhasanxuat&ma=<?php echo $row['NSX_Ma']; ?>" class="demo">
          <img src='assets/img/delete.png' width="20px" border='0' /></a>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>  
<?php
if(isset($_GET['ma'])){
  $ma  =$_GET['ma'];
  mysqli_query($Connect,"DELETE from nhasanxuat where NSX_Ma = '$ma'");
  echo "<meta http-equiv='refresh' content='0; url=?ID=nhasanxuat'/>";
}
?>
<!--Nút Thêm mới , xóa tất cả-->
<div class="row"><!--Nút chức nang-->
  <div class="col-md-4">
   <input class="btn btn-primary" type="submit" name="btnXoaNhiu" value="Xóa Các Mục Đã Chọn" onclick="XoaNhieu(event);"/>
 </div>
</div><!--Nút chức nang-->
</form>
