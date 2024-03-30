<?php
    function db_get_list_order(){
        $sql = "SELECT * FROM `tbl_order`";
        $list_order = db_fetch_array($sql);
        foreach($list_order as &$item){
            $item['detail_url'] = "?mod=checkout&action=detail&code={$item['order_code']}";
        }
        return $list_order;
    }
    function get_list_status(){
        $list_status = array(
            '1' => 'Chờ duyệt',
            '2' => 'Đang vận chuyển',
            '3' => 'Hoàn thành',
            '4' => 'Thùng rác'
        );
        return $list_status;
    }
    function get_order_status($status){
        $list_status = get_list_status();
        return $list_status[$status];
    }
    function get_list_order(){
        $sql = "SELECT * FROM `tbl_order`";
        $list_order = db_fetch_array($sql);
        foreach($list_order as &$item){
            $item['edit_url'] = "?mod=checkout&action=edit&id={$item['order_id']}";
            $item['delete_url'] = "?mod=checkout&action=delete&id={$item['order_id']}";
            $item['detail_url'] = "?mod=checkout&action=detail&code={$item['order_code']}";
        }
        return $list_order;
    }
    function order_update($order_id, $data){
        db_update('tbl_order', $data, "`order_id`='$order_id'");
    }
    function delete_order($id){
        db_delete('tbl_order', "`order_id`='$id'");
        return true;
    }
    function change_status_order($list_order_id, $action){
        foreach($list_order_id as $item){
            $sql = "UPDATE `tbl_order` SET `status`='$action' WHERE `order_id`='$item'";
            db_query($sql);
        }
        return true;
    }
    function get_list_order_by_status($status){
        $sql = "SELECT * FROM `tbl_order` WHERE `status`='$status'";
        $list_page = db_fetch_array($sql);
        foreach($list_page as &$item){
            $item['delete_url'] = "?mod=checkout&action=delete_order&id={$item['order_id']}";
            $item['move_to_bin_url'] = "?mod=checkout&action=move_to_bin&id={$item['order_id']}";
            $item['update_url'] = "?mod=checkout&action=update&id={$item['order_id']}";
            $item['detail_url'] = "?mod=checkout&action=detail&code={$item['order_code']}";
            if($status = 2){
                $item['delete_url'] = "?mod=checkout&action=delete_order&id={$item['order_id']}";
                $item['detail_url'] = "?mod=checkout&action=detail&code={$item['order_code']}";
            }
        }
        return $list_page;
    }
    function move_to_bin($order_id){
        $sql = "UPDATE `tbl_order` SET `status`='2' WHERE `page_id` = $order_id";
        db_query($sql);
        return true;
    }
    function get_list_available_order(){
        $sql =  "SELECT * FROM `tbl_order` WHERE `status` = '1'";
        $list_page = db_fetch_array($sql);
        foreach($list_page as &$item){
            $item['delete_url'] = "?mod=checkout&action=delete_order&id={$item['order_id']}";
            $item['move_to_bin_url'] = "?mod=checkout&action=move_to_bin&id={$item['order_id']}";
            $item['update_url'] = "?mod=checkout&action=update&id={$item['order_id']}";
            $item['detail_url'] = "?mod=checkout&action=detail&code={$item['order_code']}";
        }
        return $list_page;
    }
    function search_order($key_word, $status=''){ 
        if(!empty($status)){
            $sql = "SELECT * FROM `tbl_order` WHERE `full_name` LIKE '%$key_word%' AND `status`='$status'";
        }
        else{
            $sql = "SELECT * FROM `tbl_order` WHERE `full_name` LIKE '%$key_word%'";
        }
        $list_page = db_fetch_array($sql);
        foreach($list_page as &$item){
            $item['delete_url'] = "?mod=checkout&action=delete_order&id={$item['order_id']}";
            $item['move_to_bin_url'] = "?mod=checkout&action=move_to_bin&id={$item['order_id']}";
            $item['update_url'] = "?mod=checkout&action=update&id={$item['order_id']}";
            $item['detail_url'] = "?mod=checkout&action=detail&code={$item['order_code']}";

        }
        return $list_page;
    }
    function get_list_action($order_action_id = ''){
        $result = array(
            1 => 'Chờ duyệt',
            2 => 'Đang vận chuyển',
            3 => 'Hoàn thành',
            4 => 'Thùng rác'
        );
        if(!empty($order_action_id)){
            unset($result[$order_action_id]);
        }
        return $result;
    }
    function get_list_order_by_code($code){
        $sql = "SELECT * FROM `tbl_list_order` WHERE `order_code` = '$code'";
        return db_fetch_array($sql);
    }
    function get_order_by_code($code){
        $sql = "SELECT * FROM `tbl_order` WHERE `order_code`='$code'";
        $result = db_fetch_row($sql);
        return $result;
    }
    function get_payment_method($payment_id){
        $list_payment = array(
            '1' => 'Thanh toán tại nhà',
            '2' => 'Thanh toán tại cửa hàng'
        )
        ;
        return $list_payment[$payment_id];
    }
    function update_status($order_code, $status){
        $sql = "UPDATE `tbl_order` SET `status`='$status' WHERE `order_code` = '$order_code'";
        db_query($sql);
    }