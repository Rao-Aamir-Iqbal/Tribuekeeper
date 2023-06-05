<?php  

ob_start();

session_start(); 

session_regenerate_id();



// ini_set('session.cookie_secure', true);

// ini_set('session.cookie_httponly', true);

// ini_set('session.use_only_cookies', 1);



// session_start();

// session_regenerate_id();

extract($_POST); 

if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']) && is_numeric($_SESSION['admin_id']) && isset($request) && !empty($request) && isset($ID) && !empty($ID) && is_numeric($ID)){



    include_once "../requires/connect.php";

    $admin_id = $connect -> real_escape_string($_SESSION['admin_id']); 

    $query = $connect->prepare("SELECT * FROM admins WHERE ID = ?");

    $query->bind_param("s", $admin_id);

    $query->execute();

    $query_response = $query->get_result();

    if($query_response->num_rows > 0){



        if($_SESSION['USER_AGENT'] == $_SERVER['HTTP_USER_AGENT']){

            

            $query_fetch = $query_response->fetch_assoc();

            if(isset($_SESSION['dtoken']) && !empty($_SESSION['dtoken']) && isset($dtoken) && !empty($dtoken)){

    

                if($dtoken == $_SESSION['dtoken']){

    

                    unset($_SESSION['dtoken']);

                    if($request == 'video_1kill'){

            

                        $ids = !empty($bulkDeleteID) ? $bulkDeleteID : $ID; 

                        $ids = explode(",", $ids);

                        foreach($ids as $item){

                            

                            if($item !== "," && $item !== ""){

                                

                                $status = 2;

                                $update_query = $connect->prepare("UPDATE video_1kill_orders SET status = ? WHERE ID = ?");

                                $update_query->bind_param("ss", $status, $item);

                                $update_query->execute();

                                

                            }

                            

                        } 

                        

                        $_SESSION['update_success'] = "Order has been deleted successfuly!";

                        header("Location: /admin-panel/orders/video/1kill");

                        exit(); 

    

                    } if($request == 'video_3kill'){

            

                        $ids = !empty($bulkDeleteID) ? $bulkDeleteID : $ID; 

                        $ids = explode(",", $ids);

                        foreach($ids as $item){

                            

                            if($item !== "," && $item !== ""){

                                

                                $status = 2;

                                $update_query = $connect->prepare("UPDATE video_3kill_orders SET status = ? WHERE ID = ?");

                                $update_query->bind_param("ss", $status, $item);

                                $update_query->execute();

                                

                            }

                            

                        } 

                        

                        $_SESSION['update_success'] = "Order has been deleted successfuly!";

                        header("Location: /admin-panel/orders/video/3kill");

                        exit(); 

    

                    } if($request == 'video_5kill'){

            

                        $ids = !empty($bulkDeleteID) ? $bulkDeleteID : $ID; 

                        $ids = explode(",", $ids);

                        foreach($ids as $item){

                            

                            if($item !== "," && $item !== ""){

                                

                                $status = 2;

                                $update_query = $connect->prepare("UPDATE video_5kill_orders SET status = ? WHERE ID = ?");

                                $update_query->bind_param("ss", $status, $item);

                                $update_query->execute();

                                

                            }

                            

                        } 

                        

                        $_SESSION['update_success'] = "Order has been deleted successfuly!";

                        header("Location: /admin-panel/orders/video/5kill");

                        exit(); 

    

                    } if($request == 'video_10kill'){

            

                        $ids = !empty($bulkDeleteID) ? $bulkDeleteID : $ID; 

                        $ids = explode(",", $ids);

                        foreach($ids as $item){

                            

                            if($item !== "," && $item !== ""){

                                

                                $status = 2;

                                $update_query = $connect->prepare("UPDATE video_10kill_orders SET status = ? WHERE ID = ?");

                                $update_query->bind_param("ss", $status, $item);

                                $update_query->execute();

                                

                            }

                            

                        } 

                        

                        $_SESSION['update_success'] = "Order has been deleted successfuly!";

                        header("Location: /admin-panel/orders/video/10kill");

                        exit(); 

    

                    } else if($request == 'photo_1kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE photo_1kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/photo/1kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/photo/1kill");

                            exit();

    

                        }

                        

                    } else if($request == 'photo_3kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE photo_3kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/photo/3kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/photo/3kill");

                            exit();

    

                        }

                        

                    } else if($request == 'photo_5kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE photo_5kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/photo/5kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/photo/5kill");

                            exit();

    

                        }

                        

                    } else if($request == 'photo_10kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE photo_10kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/photo/10kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/photo/10kill");

                            exit();

    

                        }

                        

                    } else if($request == 'copy_1kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE copy_1kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/copy/1kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/copy/1kill");

                            exit();

    

                        }

                        

                    } else if($request == 'copy_3kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE copy_3kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/copy/3kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/copy/3kill");

                            exit();

    

                        }

                        

                    } else if($request == 'copy_5kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE copy_5kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/copy/5kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/copy/5kill");

                            exit();

    

                        }

                        

                    } else if($request == 'copy_10kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE copy_10kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/copy/10kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/copy/10kill");

                            exit();

    

                        }

                        

                    } else if($request == 'gif_1kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE gif_1kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/gif/1kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/gif/1kill");

                            exit();

    

                        }

                        

                    } else if($request == 'gif_3kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE gif_3kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/gif/3kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/gif/3kill");

                            exit();

    

                        }

                        

                    } else if($request == 'gif_5kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE gif_5kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/gif/5kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/gif/5kill");

                            exit();

    

                        }

                        

                    } else if($request == 'gif_10kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE gif_10kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/gif/10kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/gif/10kill");

                            exit();

    

                        }

                        

                    } else if($request == 'product_1kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE product_1kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/product/1kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/product/1kill");

                            exit();

    

                        }

                        

                    } else if($request == 'product_3kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE product_3kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/product/3kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/product/3kill");

                            exit();

    

                        }

                        

                    } else if($request == 'product_5kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE product_5kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/product/5kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/product/5kill");

                            exit();

    

                        }

                        

                    } else if($request == 'product_10kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE product_10kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/product/10kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/product/10kill");

                            exit();

    

                        }

                        

                    } else if($request == 'shop_1kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE shop_1kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/shop/1kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/shop/1kill");

                            exit();

    

                        }

                        

                    } else if($request == 'shop_3kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE shop_3kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/shop/3kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/shop/3kill");

                            exit();

    

                        }

                        

                    } else if($request == 'shop_5kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE shop_5kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/shop/5kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/shop/5kill");

                            exit();

    

                        }

                        

                    } else if($request == 'shop_10kill'){

                        

                        $status = 2; 

                        $update_query = $connect->prepare("UPDATE shop_10kill_order SET status = ? WHERE ID = ?");

                        $update_query->bind_param("ss", $status, $ID);

                        if($update_query->execute()){

    

                            $_SESSION['update_success'] = "Order has been deleted successfuly!";

                            header("Location: /admin-panel/orders/shop/10kill");

                            exit();

    

                        } else {

    

                            $_SESSION['update_error'] = "Unable to delete the order! Please try again...";

                            header("Location: /admin-panel/orders/shop/10kill");

                            exit();

    

                        }

                        

                    } else {

    

                        $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                        header("Location: /admin-panel/");

                        exit();

    

                    }

    

                } else {

    

                    $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                    header("Location: /admin-panel/");

                    exit();

    

                }

    

            } else {

    

                $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                header("Location: /admin-panel/");

                exit();

    

            }

            

        } else {

            

            unset($_SESSION['admin_id']);

            header("Location: ../login.php"); 

            exit();

            

        }



    } else {



        unset($_SESSION['admin_id']);

        header("Location: ../login.php");

        exit();



    }



} else {



    header("Location: /admin-panel/login");

    exit();



}