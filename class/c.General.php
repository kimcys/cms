<?php

class General{ 
    #to verify user password with api
    public static function verifyUser($user,$pswd){
   
        #url
        $url = 'https://api.hp.upm.edu.my/cron/request/verify.php';

        # initiate cur
        $ch = curl_init($url);

        # create json data
        $jsonData = array(
            'jtoken' =>  "test123",
            'id' => "$user",
            'pass'=> "$pswd"
            );
        #Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);

        #Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        
        #Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        
        #Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        #Execute the request
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return $result;

    }
}
?>