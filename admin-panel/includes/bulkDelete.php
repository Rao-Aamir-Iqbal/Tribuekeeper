<?php  

ob_start();

session_start(); 

session_regenerate_id(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ini_set('session.cookie_secure', true);

// ini_set('session.cookie_httponly', true);

// ini_set('session.use_only_cookies', 1);



// session_start();

// session_regenerate_id();

extract($_POST); 

if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']) && is_numeric($_SESSION['admin_id'])){



    include_once "../requires/connect.php";

    $admin_id = $connect -> real_escape_string($_SESSION['admin_id']); 

    $query = $connect->prepare("SELECT * FROM admins WHERE ID = ?");

    $query->bind_param("s", $admin_id);

    $query->execute();

    $query_response = $query->get_result();

    if($query_response->num_rows > 0){

        $query_fetch = $query_response->fetch_assoc();


        $ids = !empty($bulkid) ? $bulkid : $ID; 

        $ids = explode(",", $ids);
        $result = false;

        foreach($ids as $item){

            if($item !== "," && $item !== ""){

                $tables = array(
                    1 =>  array(
                        1   =>  "video_1kill_orders",
                        2   =>  "video_3kill_orders",
                        3   =>  "video_5kill_orders",
                        4   =>  "video_10kill_orders"
                    ),
                    2 =>  array(
                        1   =>  "photo_1kill_order",
                        2   =>  "photo_3kill_order",
                        3   =>  "photo_5kill_order",
                        4   =>  "photo_10kill_order"
                    ),
                    3 =>  array(
                        1   =>  "copy_1kill_order",
                        2   =>  "copy_3kill_order",
                        3   =>  "copy_5kill_order",
                        4   =>  "copy_10kill_order"
                    ),
                    4 =>  array(
                        1   =>  "gif_1kill_order",
                        2   =>  "gif_3kill_order",
                        3   =>  "gif_5kill_order",
                        4   =>  "gif_10kill_order"
                    ),
                    5 =>  array(
                        1   =>  "product_1kill_order",
                        2   =>  "product_3kill_order",
                        3   =>  "product_5kill_order",
                        4   =>  "product_10kill_order"
                    ),
                    6 =>  array(
                        1   =>  "shop_1kill_order",
                        2   =>  "shop_3kill_order",
                        3   =>  "shop_5kill_order",
                        4   =>  "shop_10kill_order"
                    ),
                );
    
                $item_explode = explode(".", $item);
                $row_id = $item_explode[0];
                $parent = $item_explode[1];
                $child = $item_explode[2];
                $target_table = $tables[$parent][$child];
                
                $status = 2;

                $update_query = $connect->prepare("UPDATE $target_table SET status = ? WHERE ID = ?");

                $update_query->bind_param("ss", $status, $row_id);

                if($update_query->execute()){

                    $result = true;

                } else {

                    $result = false;

                }

            }
            

        } 

        if($result == true){

            $_SESSION['update_success'] = "Orders has been deleted successfuly!";

            header("Location: /admin-panel/orders/video/1kill");
    
            exit(); 

        } else if($result == false) {

            $_SESSION['update_success'] = "Orders has been deleted successfuly, may some records is unable to delete!";

            header("Location: /admin-panel/orders/video/1kill");
    
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