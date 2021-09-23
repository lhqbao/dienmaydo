    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <?php
    include '../connect.php';
    ?>
    <script>
// import jquery and the plugin first
$(document).ready(function () {
 $('.Xoa').click(function (event) {
            // http://api.jquery.com/event.preventdefault/
            event.preventDefault();
             //lấy về href cần xử lý
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
                   swal({
                    title: "Xóa Thành Công",
                    type: "success"
                  },
                  function()
                  {
                    setTimeout(function(){
                      window.location.href=url;},100);
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
    form.submit();// submitting the form when user press yes
  } else {
    swal("Hủy Bỏ","", "error");
  }
});
}
</script>
<?php 
if(isset($_GET['ma']))
{
  $Ma = $_GET['ma'];
  mysqli_query($Connect,"DELETE from sanpham where SP_Ma = '$Ma'");
  echo "<meta http-equiv='refresh' content='0, URL=?ID=sanpham'/>";
}
?>
<div>
  <h1 style="margin-top:0;">Quản lý sản phẩm</h1>
  <form method="POST" action="SP_Export.php">
    <a href="?ID=sanphamthemmoi"><span class="btn btn-primary">Thêm Mới</span></a>
    <button class="pull-right btnExport btn btn-primary" type="submit" name="btnExport">Xuất Dữ Liệu Ra File Excel</button>
  </form>
  <p>&nbsp;</p>
  <form action="?ID=quanly_xoanhieu_SP" method="POST">
    <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">

      <thead>
        <tr>
          <th class="text-center"><strong>Chọn</strong></th>
          <th class="text-center"><strong>Mã sản phẩm</strong></th>
          <th class="text-center"><strong>Tên sản phẩm</strong></th>
          <th class="text-center"><strong>Giá</strong></th>
          <th class="text-center"><strong>Số lượng</strong></th>
          <th class="text-center"><strong>Loại sản phẩm</strong></th>
          <th class="text-center"><strong>Nhà sản xuất</strong></th>
          <th class="text-center"><strong>Hình ảnh</strong></th>
          <th class="text-center"><strong>Cập nhật</strong></th>
          <th class="text-center"><strong>Xóa</strong></th>
        </tr>
      </thead>

      <tbody>
        <?php

        $result = mysqli_query($Connect,"SELECT a.*,(SELECT b.HSP_TenTapTin FROM hinhsanpham b WHERE a.SP_Ma = b.SP_Ma LIMIT 0,1) as HinhSanPham, LSP_Ten, NSX_Ten FROM sanpham a JOIN loaisanpham c ON a.LSP_Ma = c.LSP_Ma JOIN nhasanxuat d ON a.NSX_Ma = d.NSX_Ma ORDER BY SP_Ma");
        while($row=mysqli_fetch_array($result)){
          ?>
          <tr>
            <td style="vertical-align: middle;"><input type="checkbox" name="checkbox[]" value="<?php echo $row['SP_Ma']; ?>"/></td>
            <td style="vertical-align: middle;"><?php echo $row["SP_Ma"] ?></td>
            <td style="vertical-align: middle;"><?php echo $row["SP_Ten"] ?></td>
            <td style="vertical-align: middle;"><?php echo number_format($row["SP_GiaHienTai"],0,",",","); ?></td>
            <td style="vertical-align: middle;"><?php echo $row["SP_SoLuong"] ?></td>
            <td style="vertical-align: middle;"><?php echo $row["LSP_Ten"] ?></td>
            <td style="vertical-align: middle;"><?php echo $row["NSX_Ten"] ?></td>
            <td align='center' class='cotNutChucNang'><img src='../img/Anh_SP/<?php echo $row['HinhSanPham'] ?>' border='0' width=100px /></td>

            <td style="vertical-align: middle;" align='center' class='cotNutChucNang'>
              <a href="?ID=sanphamcapnhat&ma=<?php echo $row['SP_Ma']; ?>"><img src='assets/img/update.png' width="20px" border='0'/></a>
            </td>

            <td style="vertical-align: middle;" align='center' class='cotNutChucNang'>
              <a href="?ID=sanpham&ma=<?php echo $row['SP_Ma']; ?>" class="Xoa"><img src='assets/img/delete.png' width="20px" border='0' /></a>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>  
    <div class="row">
      <div class="col-lg-12">
        <input class="btn btn-primary" type="submit" name="btnXoaNhieu" value="Xóa Các Mục Đã Chọn" onclick="XoaNhieu(event);"/> 
      </div>
    </div>
  </form>
</div>
