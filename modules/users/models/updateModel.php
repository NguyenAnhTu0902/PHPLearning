<?php 
function update_info_user($username, $data){
    db_update('`tbl_user`', $data, "`username`='$username'");
}