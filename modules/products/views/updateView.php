<?php 
    $product = $data['product'];
    $action_status = isset($data['action_status'])?$data['action_status']:false; 
?>
<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="section-detail row">
                        <div class="col col-lg-9">
                            <label for="product-title">Tên sản phẩm</label>
                            <input type="text" name="product_title" id="product-title" value="<?php echo $product['product_title'] ?>">
                            <div class='form-error'><?php form_error('product_title') ?></div>
                            <label for="price">Giá sản phẩm</label>
                            <input type="text" name="price" id="price" value="<?php echo $product['price'] ?>">
                            <label for="price">Giá niêm yết trước</label>
                            <input type="text" name="del_price" id="price" value="<?php echo $product['del_price'] ?>">
                            <div class='form-error'><?php form_error('price') ?></div>
                            <label for="desc">Mô tả ngắn</label>
                            <textarea name="desc" id="desc"><?php echo $product['product_desc'] ?></textarea>
                            <?php form_error('desc') ?>
                            <label for="content">Chi tiết</label>
                            <?php form_error('content') ?>
                            <textarea name="content" id="content" class="ckeditor"><?php echo $product['product_content'] ?></textarea>
                        </div>
                        <div class="col col-lg-3">
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="file" id="upload-thumb">
                                <img src="<?php echo $product['img_thumb'] ?>">
                            </div>
                            <div class='form-error'><?php form_error('cat_id') ?></div>
                            <label>Trạng thái</label>
                            <select name="status" id='product-status' data-value="<?php echo $product['status'] ?>">
                                <option value="0">-- Trạng thái sp --</option>
                                <option value="1" id='product-status-1'>Chờ duyệt</option>
                                <option value="2" id='product-status-2'>Đã đăng</option>
                            </select>
                            <div style='color:green'><?php if($action_status){ echo 'Cập nhật sản phẩm thành công'; } ?></div>
                            <button type="submit" name="btn-update" id="btn-add">Cập nhật</button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>