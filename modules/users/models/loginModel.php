<?php 
    function check_login($username, $password){
        $sql = "SELECT * FROM `tbl_user` WHERE `username`='{$username}' AND `password`='{$password}'";
        $num = db_num_rows($sql);
        if($num>0){
            $sql = "SELECT * FROM `tbl_user` WHERE `username`='{$username}'";
            if(db_num_rows($sql)>0){
                return TRUE;
            }
        }
        return FALSE;
    }