<?php 
    function is_username($fullname){
        $parttern = "/^[A-Za-z0-9_]{3,32}$/";
        if(!preg_match($parttern, $fullname)){
            return FALSE;
        }
        return TRUE;
    }
    function is_password($password){
        $parttern = "/^[a-zA-Z0-9.!@#$%^&*()]{6,32}$/";
        if(!preg_match($parttern, $password)){
            return FALSE;
        }
        return TRUE;
    }
    function is_email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }
        return TRUE;
    }
   
    function set_value($field){
        global $_POST;
        if(isset($_POST[$field])){
            return $_POST[$field];
        }
    }
    function is_exist($username, $email){
        global $conn;
        if(!empty($username) && !empty($email)){
            $sql = "SELECT * FROM `tbl_user` WHERE `username`='$username' OR `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num>0){
            return TRUE;
        }
        }
        return FALSE;
    }
    function form_error($label){
        global $data;
        if(isset($data['error'])){
           $error = $data['error'];
           if(!empty($error[$label])){
           echo "<p style='color:red'>$error[$label]</p>";
        }
        }
        
        
    }
?>