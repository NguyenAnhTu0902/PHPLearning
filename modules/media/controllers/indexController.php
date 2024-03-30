<?php 
    function construct(){
        load('helper','paging');
        load('helper', 'url');
        load_model('index');
        load('lib','validation');
    }
    function indexAction(){
        $directory = 'public/uploads/';
        $data['dir'] = $directory;
        function get_list_img_name($list_img_name){
            $result = array();
            unset($list_img_name[0]);
            unset($list_img_name[1]);
            foreach($list_img_name as $key => $value){
                $result[] = $value;
            }
            return $result;
        }
        if(isset($_POST['sm_action'])){
            $action = (int)$_POST['actions'];
            $list_item = $_POST['checkItem'];
            if($action == 1){
                delete_array_img($list_item);
            }
        }
        $list_img_name = get_list_img_name(scandir($directory));
        if (isset($_POST['btn-search'])) {
            $key_word = $_POST['key-word'];
            $list_img_name = standardlize_array_from_db(search_img($key_word,), 'img_name'); 
        }
        $data['count'] = count($list_img_name);
        //Phân trang
        $page_number = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        $data['current_page'] = $page_number;
        $data_paging = paging($list_img_name, 20, 'page_number');
        $data['list_img_name'] = $data_paging['list_item_on_page'];
        $data['total_page'] = $data_paging['total_page'];
        load_view('index', $data);
    }
    function deleteAction(){
        $link = 'public/uploads/'.$_GET['img_name'];
        $page_number = $_GET['page_number'];
        db_delete('tbl_img', $where = "`img_name`='{$_GET['img_name']}'");
        if(file_exists($link)){
        unlink($link);
        redirect("?mod=media&action=index&page_number=$page_number");
        }
    }