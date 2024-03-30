<?php
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
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left" id='list-status' data-value='<?php echo $status_id ?>'>
                            <li class="publish" id='status-1'><a href="?mod=checkout&action=index&status_id=1">Chờ duyệt <span class="count">(<?php echo count($data['list_pending_order']) ?>)</span></a> |</li>
                            <li class="publish" id='status-2'><a href="?mod=checkout&action=index&status_id=2">Đang vận chuyển <span class="count">(<?php echo count($data['list_tracking_order']) ?>)</span></a> |</li>
                            <li class="publish" id='status-3'><a href="?mod=checkout&action=index&status_id=3">Hoàn thành <span class="count">(<?php echo count($data['list_done_order']) ?>)</span></a> |</li>
                            <li class="pending" id='status-4'><a href="?mod=checkout&action=index&status_id=4">Thùng rác<span class="count">(<?php echo count($data['on_bin_order']) ?>)</span></a></li>
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
                                <?php foreach($data['list_action'] as $key => $value){ ?>
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
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data['list_order_on_page'])){ ?>
                                <?php $temp = 1; foreach($data['list_order_on_page'] as $item){ ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value='<?php echo $item['order_id'] ?>'></td>
                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                    <td><span class="tbody-text"><?php echo $item['order_code'] ?></h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['full_name'] ?></a>
                                        </div>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['num_order'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo currency_format($item['total']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo get_order_status($item['status']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['order_date'] ?></span></td>
                                    <td><a href="<?php echo $item['detail_url'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Số sản phẩm</span></td>
                                    <td><span class="tfoot-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                    <td><span class="tfoot-text">Chi tiết</span></td>
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
                            <a href="<?php echo "?mod=checkout&action=index&page_number={$prev_page}" ?>" title="">
                                <</a>
                        </li>
                        <?php for ($i = 1; $i <= $data['total_page']; $i++) { ?>
                            <li class="<?php if ($i == $data['current_page']) {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo "?mod=checkout&action=index&page_number=$i" ?>" title=""><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo "?mod=checkout&action=index&page_number={$next_page}" ?>" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>