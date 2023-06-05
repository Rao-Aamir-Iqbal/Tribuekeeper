<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
 session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
    header("location: /login");
}


$user_id = $_SESSION['user_id'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/stripe-php-master/init.php';
$stripe = new \Stripe\StripeClient('sk_test_51MebYrAvrdybUPpymlJjleUJIhHmblO5fJ1UtWgACp0U6r3ErplFZ1aBWDDdfWBJrJwXPMiq4ouv23J2W3B4vFe600NHybzzI5');

// echo $sessionId = $_GET['session_id'];

// // Now you can use the $sessionId variable to retrieve the transaction details from Stripe API
// $stripe->checkout->sessions->retrieve($sessionId);
$sessionId = $_GET['session_id'];
$currentTimestamp = date("Y-m-d H:i:s");
mysqli_query($con, "INSERT INTO `transactions`(`user_id`, `amount`, `date`) VALUES ('$user_id','2000','$currentTimestamp')");


mysqli_query($con, "UPDATE `users` SET `membership`='1' WHERE `ID` = '$user_id'");

// try {
//     // Retrieve the session object from Stripe API
//     $session = $stripe->checkout->sessions->retrieve($sessionId);
    
//     // Access the payment intent ID
//     $paymentIntentId = $session->paymentIntents;
//     echo $amount = $paymentIntent->amount;
//     echo $currency = $paymentIntent->currency;
//     // Make sure the paymentIntentId is not null or empty
//     if (!empty($paymentIntentId)) {
//         // Retrieve the payment intent object from Stripe API
//         $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);
//        echo "by lod"; 
//         // Access the transaction details
//       echo $transactionId = $paymentIntent->id;
     
//         // ... and other relevant transaction details
        
//         // Do something with the transaction details
//         // e.g., store them in your database or display to the user
//     } else {
//         echo "error1";
//         // Handle the case when the payment intent ID is not available
//         // Display an error message or take appropriate actions
//     }
    
// } catch (\Stripe\Exception\ApiErrorException $e) {
//     echo "error2";
//     // Handle any API errors that occur during retrieval
//     // Log the error, display an error message, or take appropriate actions
// }


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

    ?>
    <div class="container">
        <div class="text-center">
            <h1 class="mt-5">Payment Successful!</h1>
            <p class="lead">Thank you for your purchase. Your payment was successfully processed.</p>
            <!-- <p class="mt-3">Order ID: <?php echo $order['id']; ?></p>
            <p class="mt-3">Payment ID: <?php echo $payment['id']; ?></p> -->
            <p class="mt-3">For any inquiries or assistance, please contact our support team.</p>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
?>
</body>
</html>
