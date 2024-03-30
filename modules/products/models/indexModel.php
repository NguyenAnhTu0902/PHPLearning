<?php 
    function db_add_product($product_array){
        db_insert('tbl_product', $product_array);
        return true;
    }
    function get_list_product(){
        $sql = "SELECT * FROM `tbl_product`";
        $list_product = db_fetch_array($sql);
        foreach($list_product as &$item){
            $item['move_to_bin_url'] = "?mod=products&action=move_to_bin&id={$item['product_id']}";
            $item['delete_url'] = "?mod=products&action=delete_product&id={$item['product_id']}";
            $item['update_url'] = "?mod=products&action=update_product&id={$item['product_id']}";
        }
        return $list_product;
    }
    function get_product_by_id($product_id){
        $sql = "SELECT * FROM `tbl_product` WHERE `product_id` = '{$product_id}'";
        return db_fetch_row($sql);
    }
    function db_delete_product($product_id){
        $sql = "DELETE FROM `tbl_product` WHERE `product_id` = '{$product_id}'";
        db_query($sql);
    }
    function db_update_product($product_id, $product_info  ){
        $where = "`product_id` = '$product_id'";
        db_update('tbl_product',$product_info, $where);
    }
    function db_add_cat($cat_info){
        db_insert('tbl_cat', $cat_info);
        return true;
    }
    function db_get_list_cat(){
        $sql = "SELECT * FROM `tbl_cat`";
        $list_cat = db_fetch_array($sql);
        foreach($list_cat as &$item){
            $item['update_url'] = "?mod=products&action=update_cat&id={$item['cat_id']}";
            $item['delete_url'] = "?mod=products&action=delete_cat&id={$item['cat_id']}";
        }
        return $list_cat;
    }
    //Chuyển mảng đa chiều lấy từ database sang mảng 1 chiều dạng $key => $value
    function standardlize_array_from_db($array, $key){
        $result = array();
        foreach($array as $item){
            $result[] = $item[$key];
        }
        return $result;
    }
    function db_get_list_sorted_parents_cat(){
        $sql = "SELECT `cat_id` FROM `tbl_cat` WHERE `parents_cat_id`=0";
        return standardlize_array_from_db(db_fetch_array($sql), 'cat_id');
    }
    function db_get_list_parents_cat(){
        $sql = "SELECT *  FROM `tbl_cat` WHERE `parents_cat_id`=0";
        $list_cat = db_fetch_array($sql);
        return $list_cat;
    }
    function db_get_sorted_list_cat(){
        $list_parents_cat = db_get_list_sorted_parents_cat();
        $sorted_list_cat = array();
        foreach($list_parents_cat as $key => $value){
            $sql = "SELECT `cat_id` FROM `tbl_cat` WHERE `parents_cat_id`='$value'";
            $child_array = standardlize_array_from_db(db_fetch_array($sql), 'cat_id');
            $sorted_list_cat[$value] = $child_array;
        }
        return $sorted_list_cat;
    }
    function db_get_cat_by_id($cat_id){
        $sql = "SELECT * FROM `tbl_cat` WHERE `cat_id`='$cat_id'";
        $cat = db_fetch_row($sql);
        $cat['update_url'] = "?mod=products&action=update_cat&id={$cat['cat_id']}";
        $cat['delete_url'] = "?mod=products&action=delete_cat&id={$cat['cat_id']}";
        return $cat;
    }
    function is_parents_cat($cat_id){
        $sql = "SELECT * FROM `tbl_cat` WHERE `cat_id`='$cat_id' AND `parents_cat_id`=0";
        if(db_num_rows($sql)>0){
            return true;
        }
        return false;
    }
    function db_update_cat($cat_id,$cat_info){
        $where = "`cat_id`='$cat_id'";
        db_update('tbl_cat', $cat_info, $where);
        return true;
    }
    function get_list_status(){
        $list_status = array(
            1 => 'Chờ duyệt',
            2 => 'Đã đăng',
            3 => 'Thùng rác'
        );
        return $list_status;
    }
    function get_product_cat_name_by_id($id){
        $sql = "SELECT `tbl_product`.`product_id`, `tbl_cat`.`cat_title` FROM `tbl_product` JOIN `tbl_cat` ON `tbl_product`.`cat_id`=`tbl_cat`.`cat_id`";
        $join_array = db_fetch_array($sql);
        $result = array();
        foreach($join_array as $item){
            $result[$item['product_id']] = $item['cat_title'];
        }
        return $result[$id];
    }
    function get_list_product_by_status($status){
        $sql = "SELECT * FROM `tbl_product` WHERE `status`='$status'";
        $list_product = db_fetch_array($sql);
        foreach($list_product as &$item){
            $item['delete_url'] = "?mod=products&action=delete_product&id={$item['product_id']}";
            $item['move_to_bin_url'] = "?mod=products&action=move_to_bin&id={$item['product_id']}";
            $item['update_url'] = "?mod=products&action=update_product&id={$item['product_id']}";
            if($status = 3){
                $item['delete_url'] = "?mod=products&action=delete_product&id={$item['product_id']}";
            }
        }
        return $list_product;
    }
    function change_status_products($list_product_id, $action){
        foreach($list_product_id as $item){
            $sql = "UPDATE `tbl_product` SET `status`='$action' WHERE `product_id`='$item'";
            db_query($sql);
        }
    }
    function move_to_bin($product_id){
        $sql = "UPDATE `tbl_product` SET `status`='3' WHERE `product_id` = $product_id";
        db_query($sql);
        return true;
    }
    function get_list_availabe_product(){
        $sql =  "SELECT * FROM `tbl_product` WHERE `status` = '1' or `status` = '2'";
        $list_product = db_fetch_array($sql);
        foreach($list_product as &$item){
            $item['delete_url'] = "?mod=products&action=delete_product&id={$item['product_id']}";
            $item['move_to_bin_url'] = "?mod=products&action=move_to_bin&id={$item['product_id']}";
            $item['update_url'] = "?mod=products&action=update_product&id={$item['product_id']}";
        }
        return $list_product;
    }
    function get_list_action($page_action_id = ''){
        $result = array(
            1 => 'Chờ duyệt',
            2 => 'Công khai',
            3 => 'Thùng rác'
        );
        if(!empty($page_action_id)){
            unset($result[$page_action_id]);
        }
        return $result;
    }
    function search_products($key_word, $status=''){ 
        if(!empty($status)){
            $sql = "SELECT * FROM `tbl_product` WHERE `product_title` LIKE '%$key_word%' AND `status`='$status'";
        }
        else{
            $sql = "SELECT * FROM `tbl_product` WHERE `product_title` LIKE '%$key_word%'";
        }
        $list_product = db_fetch_array($sql);
        foreach($list_product as &$item){
            $item['delete_url'] = "?mod=products&action=delete_product&id={$item['product_id']}";
            $item['move_to_bin_url'] = "?mod=products&action=move_to_bin&id={$item['product_id']}";
            $item['update_url'] = "?mod=products&action=update_product&id={$item['product_id']}";
        }
        return $list_product;
    }
    function get_list_product_by_cat_id($cat_id){
        $sql = "SELECT * FROM `tbl_product` WHERE `cat_id`='$cat_id'";
        return db_fetch_array($sql);
    }
    function delete_cat_by_id($cat_id){
        $sql = "DELETE FROM `tbl_cat` WHERE `cat_id` = '$cat_id'";
        $cat = db_get_cat_by_id($cat_id);
        unlink($cat['img_thumb']);
        db_query($sql);
        $list_product = get_list_product_by_cat_id($cat_id);
        foreach($list_product as $item){
            $product_id = $item['product_id'];
            $img_thumb = $item['img_thumb'];
            unlink($img_thumb);
            $sql = "DELETE FROM `tbl_product` WHERE `product_id`='$product_id'";
            db_query($sql);
        }
     }
?>