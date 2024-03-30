<?php 
    function check_pass($username,$password){
        $sql = "SELECT * FROM `tbl_user` WHERE `username`='$username' AND `password`='$password'";
        if(db_num_rows($sql)>0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function change_pass($username, $password){
        $sql = "UPDATE `tbl_user` SET `password`='$password' WHERE `username` = '$username'";
        db_query($sql);
    }