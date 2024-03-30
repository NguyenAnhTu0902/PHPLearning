<?php
$action_status = isset($data['action_status'])?$data['action_status']:false;
?>

<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm nhân viên</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <form method="POST" action="">
                    <div class="section-detail row">
                        <div class="col col-lg-9">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>">
                            <div class='form-error'><?php form_error('fullname') ?></div>
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" name="username" value="<?php echo set_value('username') ?>">
                            <div class='form-error'><?php form_error('username') ?></div>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo set_value('email') ?>">
                            <div class='form-error'><?php form_error('email') ?></div>
                            <label for="password">Mật khẩu</label>
                            <input style="display: block;padding: 5px 10px;border: 1px solid #ddd;width: 35%;margin-bottom: 15px;" type="password" name="password" id="password" value="<?php echo set_value('password') ?>">
                            <div class='form-error'><?php form_error('password') ?></div>
                            <div class='form-error'><?php form_error('match-password') ?></div>
                            <label for="confirm-pass">Xác nhận mật khẩu</label>
                            <input style="display: block;padding: 5px 10px;border: 1px solid #ddd;width: 35%;margin-bottom: 15px;" type="password" name="confirm-pass" id="confirm-pass" value="<?php echo set_value('confirm-pass') ?>">
                            <div class='form-error'><?php form_error('confirm-pass') ?></div>
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address') ?>">
                            <div class='form-error'><?php form_error('address') ?></div>
                            <label for="phone_number">Số điện thoại</label>
                            <input type="text" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number') ?>">
                            <div class='form-error'><?php form_error('phone_number') ?></div>
                            <label for="username">Giới tính</label>
                            <select style="display: block;padding: 5px 10px;border: 1px solid #ddd;width: 35%;margin-bottom: 15px;" name="gender" id="gender">
                                <option value="">----Chọn giới tính----</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                            <div class='form-error'><?php form_error('gender') ?></div>
                            <div class="form-error"><?php form_error('status') ?></div>
                            <?php  if($action_status){ ?>
                                <div style='color:green'>Thêm nhân viên thành công</div>
                                <div><a href="?mod=users&controller=team&action=add">Thêm nhân viên mới</a></div>
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
