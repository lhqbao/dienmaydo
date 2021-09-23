    <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <h1>Danh sách đơn hàng</h1>
    <form method="POST" action="XuatDonHang.php">
      <button type="submit" class="btn btn-primary pull-right" name="btnExport">Xuất Đơn Hàng</button>
    </form>
    <table id="tablesalomon" class="table table-striped table-bordered text-justify" cellspacing="0" width="100%" >
      <thead>
        <tr>
          <th class="text-center"><strong>Mã Đơn Hàng</strong></th>
          <th class="text-center"><strong>Ngày Lập</strong></th>
          <th class="text-center"><strong>Nơi Giao</strong></th>
          <th class="text-center"><strong>Trạng Thái Thanh Toán</strong></th>
          <th class="text-center"><strong>Hình Thúc Thanh Toán</strong></th>
          <th class="text-center"><strong>Tên Tài Khoản</strong></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = mysqli_query($Connect,"Select * from donhang");
        while($row = mysqli_fetch_array($sql))
        {
         ?>
         <tr>
          <td align="center" style="vertical-align: middle;"><a href="?ID=sp_dondathang&MaDonHang=<?php echo $row['DH_Ma']?>"><?php echo $row['DH_Ma']?></a></td>
          <td align="center" style="vertical-align: middle;"><?php echo $row['DH_NgayLap']; ?></td>
          <td align="center" style="vertical-align: middle;"><?php echo $row['DH_NoiGiao']; ?></td>

          <td style="vertical-align: middle;" align='center' class='cotNutChucNang'><?php if($row['DH_TrangThaiThanhToan'] == 0){ echo "Chưa Thanh Toán"; } else echo "Đã Thanh Toán"; ?></td>
          <td style="vertical-align: middle;" align='center' class='cotNutChucNang'><?php if($row['HTTT_Ma'] == 1){ echo "Tiền Mặt"; } else if($row['HTTT_Ma'] == 2){ echo "Chuyển Khoản"; } else echo "PayPal"; ?>
        </td>
        <td align="center" style="vertical-align: middle;"><?php echo $row['KH_User']; ?></td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table> 
</div>
</div><!--Nút chức nang-->
