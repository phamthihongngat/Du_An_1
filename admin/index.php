<?php
    include "../model/pdo.php";
    include "../model/category.php";
    include '../model/brand.php';
    include '../model/product.php';
    include '../model/image_product.php';

    include "header.php";
    include "../global.php";
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch($act){
            // --------------------------Category----------------------------------
            
            case 'list_category':
                $list_category = category_select_all();
                include "category/list_cate.php";
                break;

                case 'delete_cate':
                    if(isset($_GET['id']) &&  ($_GET['id']) > 0){
                       delete_category($_GET['id']);
                    } 
                    $list_category = category_select_all();

                    include "category/list_cate.php";
               break;

               case 'add_cate':
                if(isset($_POST['themmoi']) && ($_POST['themmoi'])){
                   
                       $cate_name=$_POST['cate_name'];
                       
                       if(!empty($cate_name)){
                    
                        $cate_name_unique = category_select_name($cate_name);
                        if(is_array($cate_name_unique)){
                            $cate_name_error = "Tên này đã tồn tại";
                        }else{
                            category_insert($cate_name);
                        }
                    }else $cate_name_error = "Không được để trống !"; 
                   }
                include 'category/add_cate.php';
                break;

            case 'edit_cate':
               if(isset($_GET['id']) &&  ($_GET['id']) > 0){
                $show_one_cate =  category_select_by_id($_GET['id']);
                } 
             
               include 'category/update_cate.php';  
               break;  
               
             case 'update_cate':
               if(isset($_POST['update']) && ($_POST['update'])){
                $cate_id=$_POST['cate_id'];
                   $cate_name=$_POST['cate_name'];
                   category_update($cate_id,$cate_name); 
                //    if($cate_name!=""){
                //     $thong_bao= "Không được để trống";
                //    }else{
                    
                //    }
               }
               $list_category = category_select_all();
               include 'category/list_cate.php';
               break;  

            // --------------------------BRAND----------------------------------
            case 'list_brand':
                $list_brand = brand_select_all();
                include "brand/list_brand.php";
                break;

            case 'add_brand':
                if(isset($_POST['themmoi']) && $_POST['themmoi']){
                    $brand_name = $_POST['brand_name'];
                   
                    if(!empty($brand_name)){
                    
                        $brand_name_unique = brand_select_name($brand_name);
                        if(is_array($brand_name_unique)){
                            $brand_name_error = "Tên này đã tồn tại";
                        }else{
                            brand_insert($brand_name);
                        }
                    }else $brand_name_error = "Không được để trống !";                 
                }
                include "brand/add_brand.php";
                break;
            case 'delete':
                    if(isset($_GET['id']) &&  ($_GET['id']) > 0){
                    delete_brand($_GET['id']);
                    } 
                    $list_brand = brand_select_all();

            include 'brand/list_brand.php';
            break;

<<<<<<< HEAD
             case 'edit':
                if(isset($_GET['id']) &&  ($_GET['id']) > 0){
                  $show_one_brand =  brand_select_by_id($_GET['id']);
                 } 
              
                include 'brand/update_brand.php';
                break;  
                
              case 'update_brand':
                if(isset($_POST['update']) && ($_POST['update'])){
                    $brand_id=$_POST['brand_id'];
                    $brand_name=$_POST['brand_name'];
                    
                    brand_update($brand_id,$brand_name);
                }
                $list_brand = brand_select_all();
                include 'brand/list_brand.php';
                break;  
=======
            case 'edit':
            if(isset($_GET['id']) &&  ($_GET['id']) > 0){
                $show_one_brand =  brand_select_by_id($_GET['id']);
                } 
            
            include 'brand/update_brand.php';
            break;  
            
            case 'update_brand':
            if(isset($_POST['update']) && ($_POST['update'])){
                $brand_id=$_POST['brand_id'];
                $brand_name=$_POST['brand_name'];
                brand_update($brand_id,$brand_name);
            }
            $list_brand = brand_select_all();
            include 'brand/list_brand.php';
            break;  
>>>>>>> ee536cacb4e33e5d82568d497b2b863e9d17ee87
            // --------------------------PRODUCT----------------------------------
            case 'list_product':
               
                $list_product = product_select_all() ;
                include 'product/list_product.php';
                break;
            case 'add_product':
                if(isset($_POST['themmoi']) && $_POST['themmoi']){
                    $name = $_POST['name'] ;
                    $price = $_POST['price'] ;
                    $image = $_FILES['image']['name'] ;
                    
                    $description = $_POST['description'] ;
                    $sale = $_POST['sale'] ;
                    $create_at = $_POST['create_at'] ;
                    $view = $_POST['view'] ;
                    $cate_id  = $_POST['cate_id'] ;
                    $brand_id  = $_POST['brand_id'] ;
                    // $image_description = $_FILES['img_product']['name'] ;
                    $image_tail = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                    // $image_description_tail = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                    $tails = ['png','jpg','jpeg','pdf'];
                
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $error =[];
                
                    if(!empty($name)){
                        $product_by_name = product_select_name($name);
                        if(is_array($product_by_name)){
                            $error['name'] =" Tên sản phẩm đã tồn tại !" ;
                        }
                        if(strlen($name) > 255 ) $error['name'] = "Tên phải ngắn hơn 255 ký tự";
                    }else{
                        $error['name'] ="Nhập tên sản phẩm !"  ;
                    }
                    if(!empty($price)){
                        if($price < 0 ) $error['price'] = "Giá phải lớn hơn 0";
                    }else{
                        $error['price'] = "Nhập giá sản phẩm" ;
                    }
                
                    if(!empty($image)){
                        if(!in_array($image_tail, $tails)   ){
                            $error['image'] = "Vui lòng chọn ảnh";
                        }
                    }else{
                        $error['image'] = "Vui lòng chọn ảnh";
                    }
                
                    if(empty($description)){
                        $error['description'] = "Nhập mô tả" ;
                    }
                
                    if(empty($brand_id)){
                        $error['brand'] = "Chọn thương hiệu" ;
                    }
                    
                    if(empty($cate_id)){
                        $error['cate'] =  "Chọn danh mục";
                    }
                
                    if(!empty($sale) ){
                        if($sale < 1 || $sale > 99 ){
                            $error['sale'] = "Giảm giá phải lớn hơn và nhỏ hơn 100";
                        }
                    }else{
                        $error['sale'] = "Nhập giảm  giá";
                    }
                
                    if(!empty($view) ){
                        if($view < 1){
                            $error['view'] = "View phải lớn hơn 0";
                        }
                    }else{
                        $error['view'] = "Nhập view";
                    }
                
                    if(empty($create_at)){
                        $error['create_at'] = "Vui lòng chọn ngày" ;
                    }
                
                    if(empty($error)){
                        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                
                        product_insert($name, $price, $image, $description, $sale, $create_at, $view, $cate_id, $brand_id);
                    }
                    // if(!empty($image_description)){
                    //     if(!in_array($image_description_tail, $tails)  && filesize($image_description) > 8192){
                    //         $error['image_description'] = "Phải là ảnh  và kích thước nhỏ hơn 1mb";
                    //     }
                    // }else{
                    //     $error['image_description'] = "Vui lòng chọn ảnh";
                    // }
                
                
                }
                $list_category = category_select_all();
                $list_brand    = brand_select_all();
                include 'product/add_product.php';
                break;
           
            case 'edit_product':
                if(isset($_GET['product_id']) &&  ($_GET['product_id']) > 0){
                        $product_by_id = product_select_by_id($_GET['product_id']);
                    
                    } 
                $list_category = category_select_all();
                $list_brand    = brand_select_all();
                include 'product/update_product.php';
                break;  
            case 'update_product':
                if(isset($_POST['update']) && $_POST['update']){
                    $name_update = $_POST['name'] ;
                    $price_update = $_POST['price'] ;
                    $image_update = $_FILES['image']['name'] ;
                    
                    $description_update = $_POST['description'] ;
                    $sale_update = $_POST['sale'] ;
                    $create_at_update = $_POST['create_at'] ;
                    $view_update = $_POST['view'] ;
                    $cate_id_update  = $_POST['cate_id'] ;
                    $brand_id_update  = $_POST['brand_id'] ;
                    $product_id_update = $_POST['product_id'];
                    // $image_description = $_FILES['img_product']['name'] ;
                    $image_tail = strtolower(pathinfo($image_update, PATHINFO_EXTENSION));
                    // $image_description_tail = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                    $tails = ['png','jpg','jpeg','pdf'];
                
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $error =[];
                
                    if(!empty($name_update)){
                        
                        if(strlen($name_update) > 255 ) $error['name_update'] = "Tên phải ngắn hơn 255 ký tự";
                    }else{
                        $error['name_update'] ="Nhập tên sản phẩm !"  ;
                    }
                    if(!empty($price_update)){
                        if($price_update < 0 ) $error['price_update'] = "Giá phải lớn hơn 0";
                    }else{
                        $error['price'] = "Nhập giá sản phẩm" ;
                    }
                
                    if(!empty($image_update)){
                        if(!in_array($image_tail, $tails)   ){
                            $error['image_update'] = "Vui lòng chọn ảnh";
                        }
                    }
                    
                    if(empty($brand_id_update)){
                        $error['brand_update'] = "Chọn thương hiệu" ;
                    }
                    
                    if(empty($cate_id_update)){
                        $error['cate'] =  "Chọn danh mục";
                    }
                
                    if(!empty($sale_update) ){
                        if($sale_update < 1 || $sale_update > 99 ){
                            $error['sale_update'] = "Giảm giá phải lớn hơn và nhỏ hơn 100";
                        }
                    }else{
                        $error['sale_update'] = "Nhập giảm  giá";
                    }
                
                    if(!empty($view) ){
                        if($view < 0){
                            $error['view_update'] = "View phải lớn hơn 0";
                        }
                    }
                
                    if(empty($create_at_update)){
                        $error['create_at_update'] = "Vui lòng chọn ngày" ;
                    }
                
                    if(empty($error)){
                        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                        
                        $a ='aaaaaaaaaaaaaa';
                        product_update($product_id_update, $name_update, $price_update, $image_update, $description_update, $sale_update, $create_at_update, $view_update, $cate_id_update, $brand_id_update);
                    }
                    // if(!empty($image_description)){
                    //     if(!in_array($image_description_tail, $tails)  && filesize($image_description) > 8192){
                    //         $error['image_description'] = "Phải là ảnh  và kích thước nhỏ hơn 1mb";
                    //     }
                    // }else{
                    //     $error['image_description'] = "Vui lòng chọn ảnh";
                    // }
                
                
                }
                $list_product = product_select_all() ;
                include 'product/list_product.php';     
                break;
                
                case 'delete_product':
                    if(isset($_GET['product_id']) &&  ($_GET['product_id']) > 0){
                            $product_id = $_GET['product_id'] ;
                            product_delele_by_id($product_id);
                        } 
                        $list_product = product_select_all() ;
                    include 'product/list_product.php';
                    break;  

                // --------------------------User----------------------------------    
                
                case 'list_user':
                include 'user/list_user.php';
                break;
            default : include "home.php";
        }
    }else{
        include "home.php";
    }
?>