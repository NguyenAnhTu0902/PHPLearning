<?php
    function construct(){

    }
    function indexAction(){
        $data['title'] = "Trang chủ MVC";
        load_view('index',$data); 
    }
    function updateAction(){
        $attr = $_POST['attr'];
        echo "Attribute của thẻ button: ".$attr;
    }
?>