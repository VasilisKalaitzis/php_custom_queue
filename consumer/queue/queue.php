<?php
session_start();
include(dirname(__FILE__) . '/../db.php');

// here we retrieve the messages from the queue
if(!isset($_SESSION["queue_running"])) {
    $_SESSION["queue_running"] = 1;
    while(1) {
        $result = mysqli_query(
            $con,
            "SELECT id, action, data FROM `queue` limit 1");
        
        $row=$result->fetch_row();
        handleAction($row[0],$row[1],$row[2], $con);
    }
}

    // tech debt, each request needs to have its own file
    function handleAction($id,$action,$data, $con){
        switch ($action) {
            case "recover_password":
                // retreive user's email and password
                $result = mysqli_query(
                    $con,
                    "SELECT `email`, `password` FROM `users` where username='$data'");

                if($result->num_rows==1) {
                    
                    //send email to the user
                    $row = $result->fetch_row();
                    $email = $row[0];
                    $password = $row[1];

                    $msg = "You may use this password in order to log in: $password";
                    $subject = "Password Retrieval";
                    mail($email, $subject, $msg);

                    // remove that record from the queue
                    $result = mysqli_query(
                        $con,
                        "DELETE FROM `queue` where id=$id");
                }
                break;
            default:
                break;
        }
    }
?>