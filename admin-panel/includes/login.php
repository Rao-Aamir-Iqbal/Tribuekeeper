<?php  

ini_set('session.cookie_secure', false);
ini_set('session.cookie_httponly', true);
ini_set('session.use_only_cookies', 1);

session_start();
session_regenerate_id();
extract($_POST);
$callback = isset($_GET['callback']) && !empty($_GET['callback']) ? $_GET['callback'] : "/admin-panel/login";
if(isset($_SESSION['ltoken']) && !empty($_SESSION['ltoken'])){

    if(isset($ltoken) && !empty($ltoken)){

        if($ltoken == $_SESSION['ltoken']){

            if(isset($submit) && isset($email) && isset($password)){

                if(!empty($email) && !empty($password)){
            
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            
                   
                        require_once "../requires/config.php";
                        $captcha = $_POST['g-recaptcha-response']; 
                        $url = 'https://www.google.com/recaptcha/api/siteverify';
                        $data = array('secret' => $secret_key, 'response' => $captcha);
    
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_POST, 1);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($curl);
    
               

                        require_once "../requires/connect.php";
                        $email_value = $connect -> real_escape_string($email);
                        $query = $connect->prepare("SELECT * FROM admins WHERE email = ?");
                        $query->bind_param("s", $email_value);
                        $query->execute();
                        $query_response = $query->get_result();
                        if($query_response->num_rows > 0){
                            
                            $query_fetch = $query_response->fetch_assoc();  
                            if(password_verify($password, $query_fetch['password'])){
                            
                                unset($_SESSION['ltoken']);
                                $callback_redirect = isset($_GET['callback']) && !empty($_GET['callback']) ? $_GET['callback'] : "/admin-panel/";
                                $_SESSION['admin_id'] = $query_fetch['ID'];
                                $_SESSION['USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
                                header("Location: " . $callback_redirect);
                                exit();


                            } else {
                            
                                $_SESSION['error'] = "Email or password is incorrect!";
                                header("Location: " . $callback);
                                exit();

                    
                            }
                    
                        } else {
                    
                            $_SESSION['error'] = "Email or password is incorrect!";
                            header("Location: " . $callback);
                            exit();

                    
                        }
            
                                  
             
                
                    } else {
                
                        $_SESSION['error'] = "Your email address is invalid!";
                        header("Location: " . $callback);
                        exit();
                
                    }
            
                } else {
            
                    $_SESSION['error'] = "Fields are empty, please try again!";
                    header("Location: " . $callback);
                    exit();
            
                }
            
            } else {
             
                $_SESSION['error'] = "Fields are empty, please try again!";
                header("Location: " . $callback);
                exit();
            
            }

        } else {

            $_SESSION['error'] = "Unable to proccess the request! Please try again...";
            header("Location: " . $callback);
            exit();  

        }

    } else {

        $_SESSION['error'] = "Unable to proccess the request! Please try again...";
        header("Location: " . $callback);
        exit();  

    }

} else {

    $_SESSION['error'] = "Unable to proccess the request! Please try again...";
    header("Location: " . $callback);
    exit();  

}





