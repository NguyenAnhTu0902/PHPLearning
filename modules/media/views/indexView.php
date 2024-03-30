<?php ?>
<?php get_header() ?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách media</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $data['count'] ?>)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key-word" id="s" value='<?php echo set_value('key-word') ?>'>
                            <input type="submit" name="btn-search" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" action="" class="form-actions">
                    <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Xóa</option>
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
                                    <td><span class="thead-text">Tên file</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data['list_img_name'])){ $temp = 1; ?>
                                <?php 
                                    foreach($data['list_img_name'] as $key => $value){ 
                                        $img_url = $data['dir'].$value ;
                                        
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value='<?php echo $value; ?>'></td>
                                    <td><span class="tbody-text"><?php echo $temp; $temp++  ?></h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="<?php echo $img_url ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $value ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="<?php echo "?mod=media&action=delete&img_name=$value&page_number={$data['current_page']}" ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">Admin</span></td>
                                    <td><span class="tbody-text">12-07-2016</span></td>
                                </tr>
                                <?php 
                            }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Hình ảnh</span></td>
                                    <td><span class="tfoot-text">Tên file</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
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
                            <a href="<?php echo "?mod=post&action=index&page_number={$prev_page}" ?>" title="">
                                <</a>
                        </li>
                        <?php for ($i = 1; $i <= $data['total_page']; $i++) { ?>
                            <li class="<?php if ($i == $data['current_page']) {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo "?mod=media&action=index&page_number=$i" ?>" title=""><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo "?mod=media&action=index&page_number={$next_page}" ?>" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>