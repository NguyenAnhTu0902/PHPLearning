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
        load('helper', 'format');
        if(isset($_POST['btn-search'])){
            $key_word = $_POST['key-word'];
            $list_search_product = search_users($key_word);
            $data['is_search'] = true;
            $list_users = $list_search_product;
        }
        else {
            $list_users = get_list_users();
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
        load_view('index', $data);
    }
    function addAction(){
        load_model('add');
        load_view('add');
    }
    function updateAction(){
        load('helper', 'url');
        load_model('update');
    }
    function loginAction(){
        echo date("d/m/y h:m");
        load_model('login');
        if(isset($_POST['login-btn'])){
            $error = array();
            $remember = isset($_POST['remember'])? $_POST['remember']:false;
            //============
            //===VALIDATION
            //=============
            #username
            if(empty($_POST['username'])){
                $error['username'] = 'Không được để trống tên đăng nhập!';
            }
            else{
                if(!is_username($_POST['username'])){
                    $error['username'] = 'Tên đăng nhập không đúng định dạng';
                }
                else{
                    $username = $_POST['username'];
                }
            }
            #password
            if(empty($_POST['password'])){
                $error['password'] = 'Không để trống mật khẩu!';
            }
            else{
                $password = $_POST['password'];
            }
            if(empty($error)){
            if(!check_login($username, $password)){
                $error['login'] = 'Sai mật khẩu hoặc tên đăng nhập';
            }
            else{
                $_SESSION['login'] = array(
                    'is_login' => true,
                    'username' => $username
                );
                if($remember==true){
                    setcookie('is_login', true, time()+3600);
                    setcookie('username', $username, time()+3600);
                }
                redirect('?');
            }
        }
        }
        $data = array();
        $data['error'] = isset($error)?$error:'';
        load_view('login', $data);
    }
    function logoutAction(){
        unset($_SESSION['login']);
        unset($_COOKIE['is_login']);
        unset($_COOKIE['username']);
        redirect('?mod=users&action=login');
    }

    function update_accountAction(){
        load_model('update');
        $username = user_login();
        $user = get_user_by_username($username);
        $data = array(
                    'user' => $user
                    );
        if(isset($_POST['btn-update'])){
            $error = array();
             //=============
            //Validation===
           //=============
            #Fullname
            if(!empty($_POST['fullname'])){
                $fullname = $_POST['fullname'];
            }
            else{
                $error['fullname'] = 'Không được để trống họ tên ';
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
            #Kết luận
            if(empty($error)){
                $update_data = array(
                    'fullname' => $fullname,
                    'email' => $email,
                    'address' => $address,
                    'phone_number' => $phone_number
                );
                update_info_user($username, $update_data);
                $data['update_status'] = true;
            }
            else{
                show_array($error);
            }
        }
        load_view('update', $data);
        }

     //Change password   
    function change_passAction(){
        $user = user_login();
        $error = array();
        if(isset($_POST['btn-update'])){
            //Check password
            if(!empty($_POST['pass-old'])){
                if(check_pass($user,$_POST['pass-old'])){

                }
                else{
                    $error['pass-old'] = 'Sai mật khẩu!';
                }
            }
            else{
                $error['pass-old'] = 'Không để trống mật khẩu!';
            }
            //Validation
            if(empty($_POST['pass-new'])){
                $error['pass-new'] = 'Không để trống mật khẩu mới!';
            }
            else{
                if(!is_password($_POST['pass-new'])){
                    $error['pass-new'] = 'Mật khẩu gồm chữ hoa, chữ thường và kí tự đặc biệt';
                }
                $pass_new = $_POST['pass-new'];
            }
            if(empty($_POST['confirm-pass'])){
                $error['confirm-pass'] = 'Vui lòng nhập lại mật khẩu!';
            }
            else{
                $confirm_pass = $_POST['confirm-pass'];
            }
            if(empty($error)){
                if(empty($error)){
                    if($pass_new != $confirm_pass){
                        $error['match-password'] = 'Mật khẩu mới không khớp';
                    }
                    else{
                        change_pass($user, $pass_new);
                        $data['change_password_status'] = true;
                    }
                }
            }
        }
        $data['error'] = !empty($error)?$error:'';
        load_view('change_pass', $data);
    }
    function ajax_confirm_passAction(){
        $username = $_POST['username'];
        $old_pass = $_POST['old_pass'];
        $result = array(
            'username' => $username,
            'old_pass' => $old_pass,
        );
        if(check_pass($username, $old_pass)){
            echo '';
        }
        else{
            echo 'Sai mật khẩu';
        }
        
    }