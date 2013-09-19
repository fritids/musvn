<?php get_header(); ?>
<div class="header">
    <img id="logo" src="<?php echo get_template_directory_uri() ?>/images/logo.png" width="399" height="114">
    <div class="shopping_menu">
        <p>Xin chào,  Bạn có thể <a href="#">ĐĂNG NHẬP</a> hoặc<a href="#"> ĐĂNG KÝ </a></p>
        <div id="cart"> <a>
                <div class="cart_total">
                    <img src="<?php echo get_template_directory_uri() ?>/images/cart_icon.png" width="19" height="15" alt="Cart">
                    Giỏ hàng: 0 item(s) - 0.000đ
                    <div class="content">
                        <div class="empty">Your shopping cart is empty!</div>
                        <table>
                            <tr>
                                <td width="52px"><img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="50px" height="40px"></td>
                                <td>Tên sản phẩm</td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo get_template_directory_uri() ?>/images/sample_product2.jpg" width="50px" height="40px"></td>
                                <td>Tên sản phẩm</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </a> </div>
        <div>
            <ul>
                <li><a href="#">Yêu thích (0)</a></li>
                <li><a href="#">Tài khoản</a></li>
                <li><a href="#">Giỏ hàng</a></li>
                <li><a href="#">Thanh toán</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="top_shadow"></div>
<div class="top_menu">
    <ul>
        <li><a href="#">TRANG CHỦ</a></li>
        <li><a href="#">GIỚI THIỆU</a></li>
        <li><a href="#">CƠ SỞ SẢN XUẤT</a></li>
        <li><a href="#">BỘ SƯU TẬP</a></li>
        <li><a href="#">LIÊN HỆ</a></li>
    </ul>
    <form action="http://demo.opencart.com/index.php?route=module/currency" method="post" enctype="multipart/form-data">
        <div id="search">
            <div class="button-search"></div>
            <input type="text" name="filter_name" value="Tìm kiếm" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" />
        </div>
    </form>
</div>
<div class="slides_bg">
    <div id="slides">
        <img src="<?php echo get_template_directory_uri() ?>/images/slide1.jpg">
        <img src="<?php echo get_template_directory_uri() ?>/images/slide2.jpg">
        <img src="<?php echo get_template_directory_uri() ?>/images/slide3.jpg">
    </div>
</div>
<div class="bottom_shadow"></div>
<div class="category_bar">
    <ul id="menu">
        <li class="title"><a>HÀNG NỘI ĐỊA</a>
            <ul>
                <li><a href="#">Bình gốm</a></li>
                <li><a href="#">Lọ hoa</a></li>
                <li><a href="#">Bát Đĩa</a></li>
                <li><a href="#">Ấm chén</a></li>
                <li><a href="#">Cốc/ Tách</a></li>
                <li><a href="#">Hộp</a></li>
                <li><a href="#">Tranh</a></li>
                <li><a href="#">Con giống </a></li>
            </ul>
        </li>
        <li class="title"><a>HÀNG XUẤT KHẨU</a>
            <ul>
                <li><a href="#">Bình gốm</a></li>
                <li><a href="#">Lọ hoa</a></li>
                <li><a href="#">Bát Đĩa</a></li>
                <li><a href="#">Ấm chén</a></li>
                <li><a href="#">Cốc/ Tách</a></li>
                <li><a href="#">Hộp</a></li>
                <li><a href="#">Tranh</a></li>
                <li><a href="#">Con giống </a></li>
            </ul>
        </li>
        <li>
            <div class="title"><a>QUÀ TẶNG</a></div>
        </li>
        <li>
            <div class="title"><a>NGUYÊN VẬT LIỆU</a></div>
        </li>
        <li>
            <div class="title"><a>DU LỊCH DỊCH VỤ</a></div>
        </li>
        <li>
            <div class="line_shadow"></div>
        </li>
    </ul>
    <div class="social_box">
        <h3>Gọi cho chúng tôi</h3>
        <strong>04 123 456 78 </strong>
        <h3>Liên kết mạng xã hội</h3>
        <a href="#">
            <img src="<?php echo get_template_directory_uri() ?>/images/fb.jpg" width="32" height="32">
        </a> <a href="#">
            <img src="<?php echo get_template_directory_uri() ?>/images/tt.jpg" width="32" height="32">
        </a> </div>
</div>
<div class="box">
    <div class="title product_title"><a href="#">SẢN PHẨM NỔI BẬT</a></div>
    <div class="inner_box">
        <div class="product_box float_left"> <a href="<?php echo get_template_directory_uri() ?>/images/2826.jpg" data-lightbox="roadtrip">
                <img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="179" height="144" >
            </a>
            <div class="product_name "><a href="#">Tên sản phẩm</a></div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left"> <a href="<?php echo get_template_directory_uri() ?>/images/2826.jpg" data-lightbox="roadtrip">
                <img src="<?php echo get_template_directory_uri() ?>/images/sample_product2.jpg" width="179" height="144">
            </a>
            <div class="product_name "><a href="#">Tên sản phẩm</a></div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left"> <a href="<?php echo get_template_directory_uri() ?>/images/2826.jpg" data-lightbox="roadtrip">
                <img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="179" height="144">
            </a>
            <div class="product_name "><a href="#">Tên sản phẩm</a></div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left"> <a href="<?php echo get_template_directory_uri() ?>/images/2826.jpg" data-lightbox="roadtrip">
                <img src="<?php echo get_template_directory_uri() ?>/images/sample_product3.jpg" width="179" height="144">
            </a>
            <div class="product_name "><a href="#">Tên sản phẩm</a></div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left"> <a href="<?php echo get_template_directory_uri() ?>/images/2826.jpg" data-lightbox="roadtrip">
                <img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="179" height="144"></a>
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product2.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product3.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="title product_title"><a href="#">SẢN PHẨM MỚ</a>I</div>
    <div class="inner_box">
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product2.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product1.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
        <div class="product_box float_left">
            <img src="<?php echo get_template_directory_uri() ?>/images/sample_product3.jpg" width="179" height="144">
            <div class="product_name ">Tên sản phẩm</div>
            <div class="product_code ">Mã sản phẩm</div>
        </div>
    </div>
</div>
<?php get_footer(); ?>