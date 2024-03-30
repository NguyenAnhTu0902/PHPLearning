<?php
$list_users = $data['list_users_on_page'];
$prev_page = $data['current_page'] == 1 ? 1 : ($data['current_page'] - 1);
$next_page = $data['current_page'] == $data['total_page'] ? $data['total_page'] : ($data['current_page'] + 1);
foreach($list_users as $item){
    $item['delete_url'] = "?mod=users&action=delete&id={$item['user_id']}";
}
?>
<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách người dùng</h3>
                    <a href="?mod=users&controller=team&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key-word" id="s" value='<?php echo set_value('key-word') ?>'>
                            <input type="submit" name="btn-search" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" action="" class="form-actions">
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Tên đăng nhập</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Giới tính</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($list_users)){
                                    $temp = 1;
                                    foreach ($list_users as $item) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value='<?php echo $item['user_id'] ?>'></td>
                                            <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['fullname'] ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['username'] ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['email'] ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['address'] ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['phone_number'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['gender'] ?></span></td>
                                            <td>
                                                <a href="<?php echo $item['update_url'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a style="margin-left: 20px;" href="<?php echo $item['delete_url']?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $temp++;
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Tên đăng nhập</span></td>
                                    <td><span class="tfoot-text">Email</span></td>
                                    <td><span class="tfoot-text">Địa chỉ</span></td>
                                    <td><span class="tfoot-text">Số điện thoại</span></td>
                                    <td><span class="tfoot-text">Giới tính</span></td>
                                    <td><span class="tfoot-text">Thao tác</span></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="<?php echo "?mod=users&action=index&page_number={$prev_page}" ?>" title="">
                                <</a>
                        </li>
                        <?php for ($i = 1; $i <= $data['total_page']; $i++) { ?>
                            <li class="<?php if ($i == $data['current_page']) {
                                echo 'active';
                            } ?>">
                                <a href="<?php echo "?mod=users&action=index&page_number=$i" ?>" title=""><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo "?mod=users&action=index&page_number={$next_page}" ?>" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
