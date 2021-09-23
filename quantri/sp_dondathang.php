    <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <h1>Sản Phẩm Đơn Đặt Hàng</h1>
    <form method="POST" action="XuatSPDonHang.php?MaDonHang=<?php if(isset($_GET['MaDonHang'])){echo $_GET['MaDonHang']; } ?>">
      <button type="submit" class="btn btn-primary pull-right" name="btnExport">Xuất Sản Phẩm Đơn Hàng</button>
    </form>
    <table id="tablesalomon" class="table table-striped table-bordered text-justify" cellspacing="0" width="100%" >
      <thead>
        <tr>
          <th class="text-center"><strong>Mã Đơn Hàng</strong></th>
          <th class="text-center"><strong>Mã Sản Phẩm</strong></th>
          <th class="text-center"><strong>Tên Sản Phẩm</strong></th>
          <th class="text-center"><strong>Số Lượng</strong></th>
          <th class="text-center"><strong>Giá</strong></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_GET['MaDonHang']))
        {
          $MaDonHang = $_GET['MaDonHang'];
          $sql = mysqli_query($Connect,"SELECT  * FROM sp_dondathang a JOIN sanpham b ON a.SP_Ma = b.SP_Ma WHERE DH_Ma = $MaDonHang ");
          while($row = mysqli_fetch_array($sql))
          {
            //$Count = mysqli_query($Connect,"SELECT count(SP_Ma) as SC FROM sp_dondathang WHERE DH_Ma = $DH_Ma");
            ?>
            <tr>
              <td align="center" style="vertical-align: middle;"><?php echo $row['DH_Ma']?></td>
              <td align="center" style="vertical-align: middle;"><?php echo $row['SP_Ma']; ?></td>
              <td align="center" style="vertical-align: middle;"><?php echo $row['SP_Ten']; ?></td>
              <td align="center" style="vertical-align: middle;"><?php echo $row['SP_DH_SoLuong']; ?></td>
              <td align="center" style="vertical-align: middle;"><?php echo number_format($row['SP_DH_DonGia'],0,",",","); ?></td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>  
  </div>
</div><!--Nút chức nang-->
