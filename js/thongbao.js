// Hàm Thông Báo Đăng Nhập Thành Công
function showSwalLogin(User){
	swal({
		title: "Đăng Nhập Thành Công",
		text: "Chào Mừng " + User +  " Đã Đăng Nhập Thành Công",
		type: "success",
		//showCancelButton: true,
		//closeOnConfirm: false,
		//showLoaderOnConfirm: true,
	},
	function(){
		setTimeout(function(){
			location.reload();
		}, 100);
	});
};
function checkLogin()
{
	swal({
		title: "Vui Lòng Đăng Nhập",
		type: "info",
	},
	function(){
		setTimeout(function(){
			window.location.href='?ID=dangnhap';
		}, 100);
	});
}
function activeSucess()
{
	swal({
		title: "Thành Công",
		text: "Tài Khoản Của Bạn Đã Được Kích Hoạt",
		type: "success",
	},
	function(){
		setTimeout(function(){
			window.location.href='?ID=index';
		}, 100);
	});
}
// Hàm Thông Báo Đăng Nhập thất bại
function showSwalLoginError(){
	swal({
		title: "Đăng Nhập Thất Bại",
		text: "Kiểm Tra Lại Thông Tin Tài khoản",
		type: "error",
		//showCancelButton: true,
		//closeOnConfirm: false,
		//showLoaderOnConfirm: true,
	}
	)
};
// Hàm thong bao dang ky thanh cong
function showSwalReg(User){
	swal({
		title: "Đăng Ký Thành Công",
		text: "Chúc Mừng " + User +  " Đã Đăng Ký Thành Công, Kiểm Tra Email Để Kích Hoạt Tài Khoản",
		type: "success",
		//showCancelButton: true,
		//closeOnConfirm: false,
		//showLoaderOnConfirm: true,
	},
	function(){
		setTimeout(function(){
			window.location.href='index.php';
		},100);
	});
};
function showSwalRegError(){
	swal({
		title: "Đăng Ký Thất Bại",
		text: "Tên Tài Khoản Hoặc Email Đã Được Sử Dụng",
		type: "error",
		//showCancelButton: true,
		//closeOnConfirm: false,
		//showLoaderOnConfirm: true,
	})
};
// Hàm cập nhật thông tin tài khoản
function showSwalUpdateInfo(User)
{
	swal({
		title: "Cập Nhật Thành Công!",
		type: "success",
	},
	function()
	{
		setTimeout(function(){
			window.location.href='index.php?ID=profile&ma='+User;
		},100);
	}
	);
}
// Hàm đổi mật khẩu thành công
function showSwalChangedPass(User)
{
	swal({
		title: "Đổi Mật Khẩu Thành Công",
		type: "success",
	},
	function()
	{
		setTimeout(function(){
			window.location.href='index.php?ID=profile&ma='+User;
		},100);
	}
	);
}
// hàm đổi mật khẩu thất bại 
function showSwalChangePassErorr_1()
{
	swal({
		title: "Mật Khẩu Hiện Tại Không Đúng",
		type: "error",
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?ID=doimatkhau';
		},100);
	}
	);
}
function showSwalChangePass_2()
{
	swal({
		title: "Thất Bại",
		text: "Mật Khẩu Phải Trên 6 Ký Tự!",
		type: "info",
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?ID=doimatkhau';
		},100);
	}
	);
}
// Hàm thêm sản phẩm thất bại
function SPCoRoi()
{
	swal({
		title: "Thất Bại",
		text: "Sản Phẩm Này Đã Có Trong Dữ Liệu",
		type: "info",
	})
}
// hàm thêm sản phẩm thành công
function SPThanhCong(URL)
{
	swal({
		title: "Thêm Thành Công",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?ID='+URL;
		},200)
	}
	);
}
function LSPThanhCong()
{
	swal({
		title: "Thêm Thành Công",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?ID=loaisanpham';
		},100)
	}
	);
}
// cap nhat san pham
function CapNhatSanPham(URL)
{
	swal({
		title: "Cập Nhật Thành Công",
		type: "success",
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?ID='+URL;
		},100);
	}
	);
}
// Giỏ hàng
function AddCart(URL)
{
	swal({
		title: "Đã Thêm Vào Giỏ Hàng",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href="?ID="+URL;
		},100)
	}
	);
}
function AddCartProduct(IDSP)
{
	swal({
		title: "Đã Thêm Vào Giỏ Hàng",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?IDSP='+IDSP;
		},100)
	}
	);
}
function DatHang()
{
	swal({
		title: "Thông báo!",
		text: "Đặt Hàng Thành Công, Cảm Ơn Quý Khách!",
		type: "success"
	},
	function(){
		setTimeout(function(){
			window.location.href='?ID=index';
		});
	}
	);
}
// Yêu thích
function AddFavorite(URL)
{
	swal({
		title: "Đã Thêm Vào Mục Yêu Thích",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href="?ID="+URL;
		},100)
	}
	);
}
function AddFavoriteProduct(IDSP)
{
	swal({
		title: "Đã Thêm Vào Mục Yêu Thích",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?IDSP='+IDSP;
		},100)
	}
	);
}
function AddFavoriteProduct_Error(IDSP)
{
	swal({
		title: "Thất Bại",
		text: "Số Lượng Sản Phẩm Không Đủ, Vui Lòng Giảm Số Lượng!",
		type: "error"
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?IDSP='+IDSP;
		},100)
	}
	);
}
// Xóa Thành công
function XoaSucess(URL)
{
	swal({
		title: "Xóa Thành Công",
		type: "success"
	},
	function()
	{
		setTimeout(function(){
			window.location.href='?ID='+URL;
		});
	}
	)
}
