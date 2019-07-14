<?php

class User {

   var $username;
   var $password;

   function __construct($username, $password="")
   {
       $this->username = $username;
       $this->password = $password;
   }

   function login()
   {
       // This should probably be a part of the webserver, producer should only have added
       // the messages to the queue 

        // ask consumer if the user exists
	    $params=['username'=>$this->username, 'password'=> $this->password];
	    $options = array(
		    CURLOPT_RETURNTRANSFER => true,   
            CURLOPT_ENCODING       => "",   
            CURLOPT_URL => 'http://localhost:8888/consumer/api/user_authentication.php', 
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $is_logged_in  = curl_exec($ch);
        curl_close($ch);
        
        if ($is_logged_in == 1) {
            return 1;
        } else {
            return 0;
        }
   }

   function recover_password()
   {
        // insert message into the queeu so that consumer will take the necessary actions
        require_once(dirname(__FILE__) . '/../db.php');
        

        // probably the producer has no access to the database. In such case this 
        // should probably move to the consumer's api instead. 
        $result = mysqli_query(
            $con,
            "INSERT INTO queue(`action`,`data`) VALUES ('recover_password','$this->username')");

        return 1;
   }

} // end of class Vegetable

?>