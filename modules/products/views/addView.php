<?php 
    $thumb = isset($data['thumb'])?$data['thumb']:'';
    $action_status = isset($data['action_status'])?$data['action_status']:false; 
?>
<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="section-detail row">
                        <div class="col col-lg-9">
                            <label for="product-title">Tên sản phẩm</label>
                            <input type="text" name="product_title" id="product-title" value="<?php echo set_value('product_title') ?>">
                            <div class='form-error'><?php form_error('product_title') ?></div>
                            <label for="price">Giá sản phẩm</label>
                            <input type="text" name="price" id="price" value="<?php echo set_value('price') ?>">
                            <label for="price">Giá niêm yết trước</label>
                            <input type="text" name="del_price" id="price" value="<?php echo set_value('del_price') ?>">
                            <div class='form-error'><?php form_error('price') ?></div>
                            <label for="desc">Mô tả ngắn</label>
                            <textarea name="desc" id="desc"><?php echo set_value('desc') ?></textarea>
                            <?php form_error('desc') ?>
                            <label for="content">Chi tiết</label>
                            <?php form_error('content') ?>
                            <textarea name="content" id="content" class="ckeditor"><?php echo set_value('content') ?></textarea>
                        </div>
                        <div class="col col-lg-3">
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="file" id="upload-thumb">
                                <img src="<?php echo $thumb ?>">
                                <div class='form-error' style='color:red'><?php if(isset($data['error']['thumb'])){echo $data['error']['thumb'][0];}  ?></div>
                            </div>
                            <label>Trạng thái</label>
                            <select name="status" id='product-status' data-value="<?php echo set_value('status') ?>">
                                <option value="0">-- Trạng thái sp --</option>
                                <?php foreach($data['list_status'] as $key => $value){ ?>
                                    <option value="<?php echo $key ?>" id='<?php echo "product-status-".$key ?>'><?php echo $value ?></option>
                                <?php } ?>
                            </select>
                            <div class="form-error"><?php form_error('status') ?></div>
                            <?php  if($action_status){ ?>
                                <div style='color:green'>Thêm sản phẩm thành công</div>
                                <div><a href="?mod=products&action=add">Thêm sản phẩm mới</a></div>
                            <?php } else{ ?>
                            <button type="submit" name="btn-add" id="btn-add">Thêm mới</button>
                            <?php } ?>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>