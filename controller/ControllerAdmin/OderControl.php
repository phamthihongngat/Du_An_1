<?php

function list_order(){
    if(!isset($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page'] <= 1 ){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
    $quantity = 6;
    $total_orders = order_select_all();
    $list_order = order_select_pages($page, $quantity) ;
    $total_pages =  ceil(count($total_orders) / $quantity);
    include "order/list_oder.php";
}