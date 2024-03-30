<?php 
    function get_list_users(){
        $result = db_fetch_array("SELECT * FROM `tbl_user` WHERE `role` = 3");
        return $result;
    }
    function search_users($key_word){
        $sql = "SELECT * FROM `tbl_user` WHERE `role` = 3 AND `username` LIKE '%$key_word%'";
        $list_product = db_fetch_array($sql);
        return $list_product;
    }
    function get_user_by_id($user_id){
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '{$user_id}'";
        return db_fetch_row($sql);
    }
    function add_user($info = array()){
        if(!empty($info)){
            db_insert('tbl_user', $info);
        }
    }
    function get_user_by_username($username){
        $sql = "SELECT * FROM `tbl_user` WHERE `role` = 3 AND `username`='$username'";
        if(db_num_rows($sql)>0){
            return db_fetch_row($sql);
        }
        return false;
    }

    function get_list_staffs(){
        $result = db_fetch_array("SELECT * FROM `tbl_user` WHERE `role` = 2");
        foreach($result as &$item){
            $item['delete_url'] = "?mod=users&controller=team&action=delete_user&id={$item['user_id']}";
            $item['update_url'] = "?mod=users&controller=team&action=update_user&id={$item['user_id']}";
        }
        return $result;
    }
    function search_staff($key_word){
        $sql = "SELECT * FROM `tbl_user` WHERE `role` = 2 AND `username` LIKE '%$key_word%'";
        $list_staff = db_fetch_array($sql);
        foreach($list_staff as &$item){
            $item['delete_url'] = "?mod=users&controller=team&action=delete_user&id={$item['user_id']}";
            $item['update_url'] = "?mod=users&controller=team&action=update_user&id={$item['user_id']}";
        }
        return $list_staff;
    }

    function delete_staff($id){
        $sql = "DELETE FROM `tbl_user` WHERE `user_id` = '{$id}'";
        db_query($sql);
        return true;
    }

    function db_update_staff($user_id, $user_info  ){
        $where = "`user_id` = '$user_id'";
        db_update('tbl_user',$user_info, $where);
    }
