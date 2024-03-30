<?php
$list_product = $data['list_products_on_page'];
$prev_page = $data['current_page'] == 1 ? 1 : ($data['current_page'] - 1);
$next_page = $data['current_page'] == $data['total_page'] ? $data['total_page'] : ($data['current_page'] + 1);
$status_id = isset($data['status_id']) ? $data['status_id'] : '';
?>
<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=products&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left" id='list-status' data-value='<?php echo $status_id ?>'>
                            <li class="all" id='status-0'><a href="?mod=products&action=index">Tất cả <span class="count">(<?php echo count(get_list_availabe_product()) ?>)</span></a> |</li>
                            <li class="publish" id='status-2'><a href="?mod=products&action=index&status_id=2">Đã đăng <span class="count">(<?php echo count(get_list_product_by_status('2')) ?>)</span></a> |</li>
                            <li class="pending" id='status-1'><a href="?mod=products&action=index&status_id=1">Chờ xét duyệt<span class="count">(<?php echo count(get_list_product_by_status('1')) ?>)</span> |</a></li>
                            <li class="pending" id='status-3'><a href="?mod=products&action=index&status_id=3">Thùng rác<span class="count">(<?php echo count(get_list_product_by_status('3')) ?>)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key-word" id="s" value='<?php echo set_value('key-word') ?>'>
                            <input type="submit" name="btn-search" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" action="" class="form-actions">
                        <div class="actions">
                            <select name="action">
                                <option value="0">Tác vụ</option>
                                <?php foreach($data['list_action']  as $key => $value){ ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                <?php } ?>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Thao tác</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($list_product)){
                                    $temp = 1;
                                    foreach ($list_product as $item) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value='<?php echo $item['product_id'] ?>'></td>
                                            <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $item['img_thumb'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['product_title'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['price']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo $data['list_status'][$item['status']] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['created_by'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['created_date'] ?></span></td>
                                            <td>
                                                    <?php if($status_id!=3){ ?>
                                                        <a href="<?php echo $item['update_url'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <a style="margin-left: 20px;" href="<?php echo $item['move_to_bin_url']."&status_id=$status_id" ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <?php } else{ ?>
                                                        <a href="<?php echo $item['delete_url']?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <?php } ?>
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
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                        <td><span class="tfoot-text">Giá</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
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
                            <a href="<?php echo "?mod=products&action=index&page_number={$prev_page}" ?>" title="">
                                <</a>
                        </li>
                        <?php for ($i = 1; $i <= $data['total_page']; $i++) { ?>
                            <li class="<?php if ($i == $data['current_page']) {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo "?mod=products&action=index&page_number=$i" ?>" title=""><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo "?mod=products&action=index&page_number={$next_page}" ?>" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>