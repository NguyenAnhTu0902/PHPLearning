<?php
function construct(){
    load_model('index');
    load('helper', 'url');
    load('helper','format');
    load('helper', 'paging');
    load('lib', 'validation');
}
function indexAction(){
    //===============
    //Xử lí tác vụ đối với check sản phẩm
    //===============
    if (isset($_POST['sm_action'])) {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $list_item = isset($_POST['checkItem']) ? $_POST['checkItem'] : '';
        if (!empty($action)) {
            change_status_order($list_item, $action);
        }
    }
    if (isset($_GET['status_id']) && !empty($_GET['status_id'])) {
        $status_id = !empty($_GET['status_id']) ? $_GET['status_id'] : 0;
        $data['status_id'] = $status_id;
        $list_order = get_list_order_by_status($status_id);
        #Lấy list action
        $list_action = get_list_action($status_id);
    } else {
        $list_order = get_list_available_order();
        $list_action = get_list_action();
    }
    //Search
    if (isset($_POST['btn-search'])) {
        $key_word = $_POST['key-word'];
        $status = isset($_GET['status_id']) ? $_GET['status_id'] : '';
        $list_search_order = search_order($key_word, $status);
        $data['is_search'] = true;
        $list_order = $list_search_order;
    }
    $data['list_action'] = $list_action;
    //Lấy dữ liệu sản phẩm theo trạng thái
    $data['list_order'] = $list_order;
    $page_number = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
    $data['current_page'] = $page_number;
    $list_status = get_list_status();
    $data['list_status'] = $list_status;
    //===============
    //PHÂN TRANG=====
    //===============
    $data_paging = paging($list_order, 5, 'page_number');
    $data['list_order_on_page'] = $data_paging['list_item_on_page'];
    $data['total_page'] = $data_paging['total_page'];
    $data['list_pending_order'] = get_list_order_by_status('1');
    $data['list_tracking_order'] = get_list_order_by_status('2');
    $data['list_done_order'] = get_list_order_by_status('3');
    $data['on_bin_order'] = get_list_order_by_status('4');
    load_view('index', $data);
}
function detailAction(){
    $order_code = isset($_GET['code']) ? $_GET['code'] : '';
    $order = get_order_by_code($order_code);
    if(isset($_POST['btn-update'])){
        $status = $_POST['status'];
        update_status($order_code, $status);
        $order = get_order_by_code($order_code);
    }
    $data['order'] = $order;
    $data['list_order'] = get_list_order_by_code($order_code);
    $data['list_action'] = get_list_action();
    $data['order_status'] = $order['status'];
    load_view('detail', $data);
}