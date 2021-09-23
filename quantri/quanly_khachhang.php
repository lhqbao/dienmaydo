    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <form name="frmXoa" method="post" action="">
      <h1>Quản lý khách hàng</h1>
      <!--   <p>
            <a href="?ID=khachhangthemmoi"><span class="btn btn-primary">Thêm Mới</span></a>
            <img src="assets/img/add.png" alt="Thêm mới" width="16" height="16" border="0" />
            <a href="?khoatrang=quanly_loaisanpham_themmoi"><font color="#FF0000">Thêm Loại Sản Phẩm</font></a>
            <img src="assets/img/add.png" alt="Thêm mới" width="16" height="16" border="0" />
            <a href="?khoatrang=quanly_nhasanxuat_themmoi"><font color="#0000FF">Thêm Loại Nhà Sản Xuất</font></a>
          </p> -->
          <table id="tablesalomon" class="table table-striped table-bordered table-responsive text-justify" cellspacing="0">
            <div class="container">
              <thead>
                <tr class="text-center">
                 <th class="text-center"><strong>Tên Tài Khoản</strong></th>
                 <th class="text-center"><strong>Họ Tên</strong></th>
                 <th class="text-center"><strong>Giới Tính</strong></th>
                 <th class="text-center"><strong>Địa Chỉ</strong></th>
                 <th class="text-center"><strong>Điện Thoại</strong></th>
                 <th class="text-center"><strong>Email</strong></th>
                 <th class="text-center"><strong>Năm Sinh</strong></th>
                 <th class="text-center"><strong>Trạng Thái</strong></th>
                 <th class="text-center"><strong>Quản Trị</strong></th>
               </tr>
             </thead>

             <tbody>
              <?php

              $result = mysqli_query($Connect, "SELECT * FROM khachhang");
              while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
               ?>
               <tr>
                 <td ><?php echo $row["KH_User"] ?></td>
                 <td><?php echo $row["KH_HoTen"] ?></td>
                 <td ><?php echo $row["KH_GioiTinh"] ?></td>
                 <td><?php echo $row["KH_DiaChi"] ?></td>
                 <td><?php echo $row["KH_DienThoai"] ?></td>
                 <td><?php echo $row["KH_Email"] ?></td>
                 <td ><?php echo $row["KH_NgaySinh"]."/".$row["KH_ThangSinh"]."/".$row["KH_NamSinh"] ?></td>
                 <td><?php echo $row["KH_TrangThai"] ?></td>
                 <td><?php echo $row["KH_QuanTri"] ?></td>
             </tr>
             <?php
           }
           ?>
         </tbody>
       </div>
     </table>  
   </div>
 </form>
