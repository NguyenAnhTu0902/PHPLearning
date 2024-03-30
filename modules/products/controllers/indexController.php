<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'format');
    load('helper', 'url');
    load('helper', 'paging');
}
function indexAction()
{
    
    //===============
    //Xử lí tác vụ đối với check sản phẩm
    //===============
    if(isset($_POST['sm_action'])){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $list_item = isset($_POST['checkItem']) ? $_POST['checkItem']:'';
        if(!empty($action)){
            change_status_products($list_item, $action);
        }
    }
    if(isset($_GET['status_id'])&&!empty($_GET['status_id'])){
        $status_id = !empty($_GET['status_id']) ? $_GET['status_id'] : 0;
        $data['status_id'] = $status_id;
        $list_product = get_list_product_by_status($status_id);
        #Lấy list action
        $list_action = get_list_action($status_id);

    }
    else{
        $list_product = get_list_availabe_product();
        $list_action = get_list_action();
    }
    //Search
    if(isset($_POST['btn-search'])){
        $key_word = $_POST['key-word'];
        $status = isset($_GET['status_id'])?$_GET['status_id']:'';
        $list_search_product = search_products($key_word,$status);
        $data['is_search'] = true;
        $list_product = $list_search_product;
    }
        $data['list_action'] = $list_action;
    //Lấy dữ liệu sản phẩm theo trạng thái
    $data['list_product'] = $list_product;
    $page_number = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
    $data['current_page'] = $page_number;
    $list_status = get_list_status();
    $data['list_status'] = $list_status;
    //===============
    //PHÂN TRANG=====
    //===============
    $data_paging = paging($list_product, 10, 'page_number');
    $data['list_products_on_page'] = $data_paging['list_item_on_page'];
    $data['total_page'] = $data_paging['total_page'];
    load_view('index', $data);
}
function addAction()
{
    $data = array();
    $list_status = get_list_status();
    $data['list_status'] = $list_status;
    if (isset($_POST['btn-add'])) {
        $error = array();
        //===============
        //=====VALIDATION
        //===============
        #product title
        if (empty($_POST['product_title'])) {
            $error['product_title'] = 'Không để trống tên sản phẩm!';
        } else {
            $product_title = $_POST['product_title'];
        }
        #price 
        if (empty($_POST['price'])) {
            $error['price'] = 'Không để trống giá sản phẩm';
        } else {
            $price = $_POST['price'];
        }
        #del_price
        if (!empty($_POST['del_price'])) {
            $del_price = $_POST['del_price'];
        }
        #desc
        if (empty($_POST['desc'])) {
            $error['desc'] = 'Không để trống mã sản phẩm';
        } else {
            $product_desc = $_POST['desc'];
        }
        #content
        if (empty($_POST['content'])) {
            $error['content'] = 'Không để trống chi tiết sản phẩm';
        } else {
            $product_content = $_POST['content'];
        }
        #status
        if (empty($_POST['status'])) {
            $error['status'] = 'Vui lòng chọn trạng thái sản phẩm';
        } else {
            $status = $_POST['status'];
        }
        #lấy tên file upload
        $file_name = $_FILES['file']['name'];
        $upload_dir = 'public/uploads/';
        $upload_file = $upload_dir . $_FILES['file']['name'];
        //=====================    
        //Kiểm tra file up load
        //=====================
        #Định dạng file
        $type = pathinfo($file_name, PATHINFO_EXTENSION);
        $type_allow = array('jpg', 'jpeg', 'png', 'webp');
        if (!in_array(strtolower($type), $type_allow)) {
            $data['error']['thumb'][] = 'Ảnh định dạng jg, jpeg, png, webp';
        }
        #Kiểm tra kích thước file
        $file_size = $_FILES['file']['size'];
        $file_size_allow = 20 * pow(2, 20);
        if ($file_size > $file_size_allow) {
            $data['error']['thumb'][] = 'Kích thước file vượt quá 20MB!';
        }
        #Kiểm tra nếu file đã tồn tại trên hệ thống
        if (file_exists($upload_file)) {
            $file_name = pathinfo($upload_file, PATHINFO_FILENAME);
            $new_file_name = $file_name . '-Copy';
            $new_upload_file = $upload_dir . $new_file_name;
            $k = 0;
            while (file_exists($new_upload_file)) {
                $new_file_name = $file_name . "-Copy($k).";
                $new_upload_file = $upload_dir . $new_file_name . $type;
                $k++;
            }
            $upload_file = $new_upload_file;
        }
        //Move file 
        if (empty($error['thumb'])) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                $data['thumb'] = $upload_file;
            }
        }
        if (empty($error)) {
            $created_by = user_login();
            $product_info = array(
                'product_title' => $product_title,
                'price' => $price,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'status' => $status,
                'img_thumb' => $upload_file,
                'created_by' => $created_by,
                'created_date' => date('d/m/y'),
            );
            if(isset($del_price)){
                $product_info['del_price'] = $del_price;
            }
            $data['action_status'] = true;
            db_add_product($product_info);
        } else {
            $data['error'] = $error;
        }
    }
    load_view('add', $data);
}
function delete_productAction()
{
    $product_id = $_GET['id'];
    if (db_delete_product($product_id)) {
        redirect('?mod=products&action=index&status_id=3');
    }
}
function move_to_binAction(){
    $product_id = $_GET['id'];
    $status_id = $_GET['status_id'];
    move_to_bin($product_id);
    redirect("?mod=products&action=index&status_id={$status_id}");
}
function update_productAction()
{
    $product_id = $_GET['id'];
    $product = get_product_by_id($product_id);
    $data = array();
    $data['product'] = $product;
    if (isset($_POST['btn-update'])) {
        $error = array();
        //===============
        //=====VALIDATION
        //===============
        #product title
        if (empty($_POST['product_title'])) {
            $error['product_title'] = 'Không để trống tên sản phẩm!';
        } else {
            $product_title = $_POST['product_title'];
        }
        #price 
        if (empty($_POST['price'])) {
            $error['price'] = 'Không để trống giá sản phẩm';
        } else {
            $price = $_POST['price'];
        }
         #del_price
         if (!empty($_POST['del_price'])) {
            $del_price = $_POST['del_price'];
        }
        else{
            $del_price = 0;
        }
        #desc
        if (empty($_POST['desc'])) {
            $error['desc'] = 'Không để trống mã sản phẩm';
        } else {
            $product_desc = $_POST['desc'];
        }
        #content
        if (empty($_POST['content'])) {
            $error['content'] = 'Không để trống chi tiết sản phẩm';
        } else {
            $product_content = $_POST['content'];
        }
        #status
        if (empty($_POST['status'])) {
            $error['status'] = 'Vui lòng chọn trạng thái sản phẩm';
        } else {
            $status = $_POST['status'];
        }
        #lấy tên file upload
        if (!empty($_FILES['file']['name'])) {
            $file_name = $_FILES['file']['name'];
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            //=====================    
            //Kiểm tra file up load
            //=====================
            #Định dạng file
            $type = pathinfo($file_name, PATHINFO_EXTENSION);
            $type_allow = array('jpg', 'jpeg', 'png', 'webp');
            if (!in_array(strtolower($type), $type_allow)) {
                $error['thumb'][] = 'Ảnh định dạng jg, jpeg, png, webp';
            }
            #Kiểm tra kích thước file
            $file_size = $_FILES['file']['size'];
            $file_size_allow = 20 * pow(2, 20);
            if ($file_size > $file_size_allow) {
                $error['thumb'][] = 'Kích thước file vượt quá 20MB!';
            }
            #Kiểm tra nếu file đã tồn tại trên hệ thống
            if (file_exists($upload_file)) {
                $file_name = pathinfo($upload_file, PATHINFO_FILENAME);
                $new_file_name = $file_name . '-Copy';
                $new_upload_file = $upload_dir . $new_file_name;
                $k = 0;
                while (file_exists($new_upload_file)) {
                    $new_file_name = $file_name . "-Copy($k).";
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                    $k++;
                }
                $upload_file = $new_upload_file;
            }
            //Move file 
            if (empty($error['thumb'])) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                    $data['thumb'] = $upload_file;
                }
            }
        }
        else{
            $upload_file = $product['img_thumb'];
        }
        if (empty($error)) {
            $created_by = user_login();
            $product_info = array(
                'product_title' => $product_title,
                'price' => $price,
                'img_thumb' => $upload_file,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'status' => $status,
                'created_by' => $created_by,
                'del_price' => $del_price
            );
            db_update_product($product_id, $product_info);
            $data['action_status'] = true;
            $data['product'] = get_product_by_id($product_id);
        } else {
            $data['error'] = $error;
            show_array($error);
        }
    }
    load_view('update', $data);
}