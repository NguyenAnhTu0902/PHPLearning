<?php get_header() ?>
<?php
    $error = !empty($data['error'])?$data['error']:'';
    $change_password_status = isset($data['change_password_status'])?isset($data['change_password_status']):false;
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('user') ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="pass-old" id="pass-old" value="<?php echo set_value('pass-old') ?>">
                        <div id='old-pass-error' style='color:red' ><?php form_error('pass-old') ?></div>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="pass-new" id="new-pass" value='<?php echo set_value('pass-new') ?>'>
                        <div><?php form_error('pass-new') ?></div>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm-pass" id="confirm-pass" value='<?php echo set_value('confirm-pass') ?>'>
                        <div><?php form_error('confirm-pass') ?></div>
                        <div style='color:green'><?php if($change_password_status){ echo 'Cập nhật mật khẩu thành công!'; } ?></div>
                        <button type="submit" name="btn-update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>