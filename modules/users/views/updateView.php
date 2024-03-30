<?php
$user = $data['user'];
$action_status = isset($data['action_status'])?$data['action_status']:false;
?>

<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật nhân viên</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <form method="POST" action="">
                    <div class="section-detail row">
                        <div class="col col-lg-9">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo $user['fullname'] ?>">
                            <div class='form-error'><?php form_error('fullname') ?></div>
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" name="username" value="<?php echo $user['username'] ?>">
                            <div class='form-error'><?php form_error('username') ?></div>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo $user['email'] ?>">
                            <div class='form-error'><?php form_error('email') ?></div>
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo $user['address'] ?>">
                            <div class='form-error'><?php form_error('address') ?></div>
                            <label for="phone_number">Số điện thoại</label>
                            <input type="text" name="phone_number" id="phone_number" value="<?php echo $user['phone_number'] ?>">
                            <div class='form-error'><?php form_error('phone_number') ?></div>
                            <div class="form-error"><?php form_error('status') ?></div>
                            <div style='color:green'><?php if($action_status){ echo 'Cập nhật nhân viên thành công'; } ?></div>
                            <button type="submit" name="btn-update" id="btn-add">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
