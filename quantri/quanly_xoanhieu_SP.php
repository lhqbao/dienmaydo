<script>
	function XoaThanhCong()
	{
		swal({
			title: "Xóa Thành Công",
			type: "success"
		},
		function()
		{
			setTimeout(function(){
				window.location.href='?ID=sanpham';
			},100)
		}
		);
	}
	function NoItem()
	{
		swal({
			title: "Lỗi",
			text: "Không Có Item Nào Được Chọn",
			type: "error"
		},
		function()
		{
			setTimeout(function(){
				window.location.href='?ID=sanpham';
			},100)
		}
		);
	}
</script>
<?php 
if(!empty($_POST['checkbox']))
{
	echo "<script>setTimeout(function(){XoaThanhCong()},100);</script>";
	for($i = 0; $i < count($_POST['checkbox']); $i++)
	{
		$MaSP = $_POST['checkbox'][$i];
		mysqli_query($Connect,"DELETE FROM sanpham where SP_Ma = '$MaSP'");
	}
}
else 
{
	echo "<script>setTimeout(function(){NoItem()},100);</script>";
}
?>