<?php 
 function search_img($key_word){
    $sql = "SELECT `img_name` FROM `tbl_img` WHERE `img_name` LIKE '$key_word%'";
    return db_fetch_array($sql);
 }

 function standardlize_array_from_db($array, $key){
    $result = array();
    foreach($array as $item){
        $result[] = $item[$key];
    }
    return $result;
}
function delete_array_img($img_array){
    foreach ($img_array as $item) {
        $link = 'public/uploads/' . $item;
        if (file_exists($link)) {
            unlink($link);
            db_delete('tbl_img', $where = "`img_name`='$item'");
        } 
    }
    return true; 
}