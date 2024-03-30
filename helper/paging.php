<?php
 function paging($list_data, $num_per_page, $page_number_label='page_number'){
    $result = array();
    if(!empty($list_data)){
        $total = count($list_data);
    if($total>0){
        $total_page = ceil($total/$num_per_page);
        $page_number = isset($_GET[$page_number_label]) ? (int)$_GET[$page_number_label] : 1;
        $start = ($page_number-1)*$num_per_page;
        $end = $page_number == $total_page ? $total:$page_number*$num_per_page;
        $i = $start;
        for($i = $start; $i <= $end-1; $i++){
        $list_item_on_page[] = $list_data[$i];
        }
    }
    $result['list_item_on_page'] = $total>0 ? $list_item_on_page : array();
    $result['total_page'] = isset($total_page) ? $total_page : 0;
    } else{
        $result['list_item_on_page'] = 0;
        $result['total_page'] = 0;
    }
    
    return $result;
 }