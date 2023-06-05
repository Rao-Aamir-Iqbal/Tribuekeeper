<?php 
ob_start();

session_start(); 

session_regenerate_id(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ini_set('session.cookie_secure', false);

// ini_set('session.cookie_httponly', true);

// ini_set('session.use_only_cookies', 1);



// session_start();

// session_regenerate_id();

extract($_POST); 
extract($_GET); 

if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']) && is_numeric($_SESSION['admin_id']) && isset($request) && isset($ID) && !empty($ID)){


    include_once "../requires/connect.php";

    $admin_id = $connect -> real_escape_string($_SESSION['admin_id']); 

    $query = $connect->prepare("SELECT * FROM admins WHERE ID = ?");

    $query->bind_param("s", $admin_id);

    $query->execute();

    $query_response = $query->get_result();

    if($query_response->num_rows > 0){


        $query_fetch = $query_response->fetch_assoc();
        
       

        if($request == ""){


            if(isset($_SESSION['utoken']) && !empty($_SESSION['utoken']) && isset($utoken) && !empty($utoken)){


                if($utoken == $_SESSION['utoken']){


                    // unset($_SESSION['utoken']);  
                    
                    $ids = !empty($bulkID) ? $bulkID : $ID;

                    $ids = explode(",", $ids);

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

                    foreach($ids as $item){   

                        
                        
                        if($item !== "," && $item !== ""){

                            $item_explode = explode(".", $item);
                            $row_id = $item_explode[0];
                            $parent = $item_explode[1];
                            $child = $item_explode[2];
                            $target_table = $tables[$parent][$child];

                            $update_query = $connect->prepare("UPDATE $target_table SET status = ? WHERE ID = ?");

                            $update_query->bind_param("ss", $status, $row_id);

                            $update_query->execute();


                        }

                        

                    }

                    

                    $_SESSION['update_success'] = "Order has been updated successfuly!";

                    header("Location: " . $callback);

                    exit();





                } else {



                    $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                    header("Location: " . $callback);

                    exit();



                }



            } else {



                $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                header("Location: " . $callback);

                exit();



            }



        } else if($request == "profile"){ 



            if(isset($_SESSION['ptoken']) && !empty($_SESSION['ptoken']) && isset($ptoken) && !empty($ptoken)){



                if($ptoken == $_SESSION['ptoken']){



                    unset($_SESSION['ptoken']); 

                    if(isset($name) && isset($email) && !empty($name) && !empty($email)){



                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){



                            $update_query = $connect->prepare("UPDATE admins SET name = ?, email = ? WHERE ID = ?");

                            $update_query->bind_param("sss", $name, $email, $admin_id);

                            if($update_query->execute()){

        

                                $_SESSION['update_success'] = "Profile has been updated successfuly!";

                                header("Location: /admin-panel/profile");

                                exit();

        

                            } else {

        

                                $_SESSION['update_error'] = "Unable to update the profile! Please try again...";

                                header("Location: /admin-panel/profile");

                                exit();

        

                            }



                        } else {



                            $_SESSION['update_error'] = "Please enter a valid email address...";

                            header("Location: /admin-panel/password");

                            exit();  



                        }



                    } else {



                        $_SESSION['update_error'] = "Fields is missing! Please try again...";

                        header("Location: /admin-panel/password");

                        exit();



                    }



                } else {



                    $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                    header("Location: /admin-panel/profile");

                    exit();



                }



            } else {



                $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                header("Location: /admin-panel/profile");

                exit();



            }



        } else if($request == "password"){



            if(isset($_SESSION['ctoken']) && !empty($_SESSION['ctoken']) && isset($ctoken) && !empty($ctoken)){



                if($ctoken == $_SESSION['ctoken']){



                    unset($_SESSION['ctoken']);  

               if(isset($current_password) && !empty($current_password) && isset($new_password) && !empty($new_password)){



                                    if(password_verify($current_password, $query_fetch['password'])){

        

                                        $hash = password_hash($new_password, PASSWORD_DEFAULT, array("cost" => 9));

                                        $update_query = $connect->prepare("UPDATE admins SET password = ? WHERE ID = ?");

                                        $update_query->bind_param("ss", $hash, $admin_id);

                                        if($update_query->execute()){

                    

                                            $_SESSION['update_success'] = "Password has been updated successfuly!";

                                            header("Location: /admin-panel/profile");

                                            exit();

                    

                                        } else {

                    

                                            $_SESSION['update_error'] = "Unable to update the profile! Please try again...";

                                            header("Location: /admin-panel/password");

                                            exit();

                    

                                        }

        

                                    } else {

        

                                        $_SESSION['update_error'] = "Current password is incorrect! Please try again...";

                                        header("Location: /admin-panel/password");

                                        exit(); 

        

                                    }

        

                                } else {

        

                                    $_SESSION['update_error'] = "Fields is missing! Please try again...";

                                    header("Location: /admin-panel/password");

                                    exit();

        

                                } 



                } else {



                    $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                    header("Location: /admin-panel/password");

                    exit();



                }



            } else {



                $_SESSION['update_error'] = "Unable to proccess the request! Please try again...";

                header("Location: /admin-panel/password");

                exit();



            }



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