<?php
function construct(){
    load_model('index');
    load('lib','validation');
    load('helper', 'url');
    load('lib','send_email');
    load_model('change_pass');
    load('helper', 'paging');
}
function indexAction(){
    if(isset($_POST['btn-search'])){
        $key_word = $_POST['key-word'];
        $list_search_staff = search_staff($key_word);
        $data['is_search'] = true;
        $list_users = $list_search_staff;
    }
    else {
        $list_users = get_list_staffs();
    }
    $data['list_users'] = $list_users;
    $page_number = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
    $data['current_page'] = $page_number;
    //===============
    //PHÂN TRANG=====
    //===============
    $data_paging = paging($list_users, 10, 'page_number');
    $data['list_users_on_page'] = $data_paging['list_item_on_page'];
    $data['total_page'] = $data_paging['total_page'];
    load_view('team', $data);
}

function addAction()
{
    $data = array();
    if (isset($_POST['btn-add'])) {
        $error = array();
        //===============
        //=====VALIDATION
        //===============
        #Fullname
        if(!empty($_POST['fullname'])){
            $fullname = $_POST['fullname'];
        }
        else{
            $error['fullname'] = 'Không được để trống họ tên ';
        }
        #Fullname
        if(!empty($_POST['username'])){
            $username = $_POST['username'];
        }
        else{
            $error['username'] = 'Không được để trống tên đăng nhập';
        }
        //Validation
        if(empty($_POST['password'])){
            $error['password'] = 'Không để trống mật khẩu!';
        }
        else{
            if(!is_password($_POST['password'])){
                $error['password'] = 'Mật khẩu gồm chữ hoa, chữ thường và kí tự đặc biệt';
            }
            $password = $_POST['password'];
        }
        if(empty($_POST['confirm-pass'])){
            $error['confirm-pass'] = 'Vui lòng nhập lại mật khẩu!';
        }
        else{
            $confirm_pass = $_POST['confirm-pass'];
        }
        if(empty($error)){
            if(empty($error)){
                if($password != $confirm_pass){
                    $error['match-password'] = 'Mật khẩu mới không khớp';
                }
                else{
                    $password = $_POST['password'];
                }
            }
        }
        #Email
        if(!empty($_POST['email'])){
            if(is_email($_POST['email'])){
                $email = $_POST['email'];
            }
            else{
                $error['email'] = 'Email không đúng định dạng';
            }
        }
        else{
            $error['email'] = 'Không được để trống email';
        }
        #Address
        if(!empty($_POST['address'])){
            $address = $_POST['address'];
        }
        else{
            $address='';
        }
        #Phone_number
        if(!empty($_POST['address'])){
            $phone_number = $_POST['phone_number'];
        }
        else{
            $phone_number='';
        }
        #Gender
        if(!empty($_POST['gender'])){
            $gender = $_POST['gender'];
        }
        else{
            $error['gender'] = 'Không được để trống gender';
        }
        #Kết luận
        if(empty($error)){
            $staff_data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'address' => $address,
                'phone_number' => $phone_number,
                'gender' => $gender,
                'role' => 2
            );
            add_user($staff_data);
            $data['action_status'] = true;
        }
        else{
            $data['error'] = $error;
        }
    }
    load_view('add', $data);
}
function delete_userAction()
{

    $user_id = $_GET['id'];
    if (delete_staff($user_id) == true) {
        redirect('?mod=users&controller=team&action=index');
    }
}

function update_userAction()
{
    $user_id = $_GET['id'];
    $user = get_user_by_id($user_id);
    $data = array();
    $data['user'] = $user;
    if (isset($_POST['btn-update'])) {
        $error = array();
        //===============
        //=====VALIDATION
        //===============
        #Fullname
        if(!empty($_POST['fullname'])){
            $fullname = $_POST['fullname'];
        }
        else{
            $error['fullname'] = 'Không được để trống họ tên ';
        }
        #Fullname
        if(!empty($_POST['username'])){
            $username = $_POST['username'];
        }
        else{
            $error['username'] = 'Không được để trống tên đăng nhập';
        }
        #Email
        if(!empty($_POST['email'])){
            if(is_email($_POST['email'])){
                $email = $_POST['email'];
            }
            else{
                $error['email'] = 'Email không đúng định dạng';
            }
        }
        else{
            $error['email'] = 'Không được để trống email';
        }
        #Address
        if(!empty($_POST['address'])){
            $address = $_POST['address'];
        }
        else{
            $address='';
        }
        #Phone_number
        if(!empty($_POST['address'])){
            $phone_number = $_POST['phone_number'];
        }
        else{
            $phone_number='';
        }

        if (empty($error)) {
            $user_info = array(
                'fullname' => $fullname,
                'username' => $username,
                'email' => $email,
                'address' => $address,
                'phone_number' => $phone_number,
            );
            db_update_staff($user_id, $user_info);
            $data['action_status'] = true;
            $data['user'] = get_user_by_id($user_id);
        } else {
            $data['error'] = $error;
            show_array($error);
        }
    }
    load_view('update', $data);
}