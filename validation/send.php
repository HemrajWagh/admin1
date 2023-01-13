        <?php
        session_start();
        $name = $tym = $message = $email = $phone = $pid = "";
        $err = [];

        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
          $conn = new PDO("mysql:host=$servername;dbname=admin1_db", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }

        if(isset($_COOKIE['__gtm_campaign_url'])){
          $utm_sourceUrl =$_COOKIE['__gtm_campaign_url'];    
        }

        // parse_url() function to parse the URL
        // and return an associative array which
        // contains its various components
        $utmUrl=parse_url($utm_sourceUrl);
        // var_dump(parse_url($utmUrl));

        // parse_str() function to parse the
        // string passed via URL
        parse_str($utmUrl['query'], $params);
        // echo ' Hi '.$params['utm_campaign'].' your emailID is '.$params['utm_medium'];

        $utmSource=$params['utm_source'];
        $utmCampaign=$params['utm_campaign'];
        $utmMedium=$params['utm_medium'];

        if(is_null($utmSource)){
          $utmSource='Organic';
        };
        if (is_null($utmMedium)) {
          $utmMedium='';
        };
        if (is_null($utmCampaign)) {
          $utmCampaign='';
        };
        $siteUrl='https://www.kumarworld.com';
        if(is_null($utm_sourceUrl)){
          $utm_Url=$siteUrl;
        }
        else{
          $utm_Url=$utm_sourceUrl;
        };
        // echo "<pre>";
        // print_r($params['utm_campaign']);
        // echo "<pre>";

        if(isset($_POST['name']) && !empty($_POST['name'])){
          $name = $_POST['name'];
        }else{
          $err['name'] = "Name is Required";
        }

        if (validate_phone_number($_POST['phone']) == true) {
         if(isset($_POST['phone']) && !empty($_POST['phone'])){
          $phone = $_POST['phone'];
        }else{
         $err['phone'] = "Mobile number is Required";
       }
     } else {
      $err['phone'] = "Invalid Mobile number";
    }

        // var_dump(strlen($_POST['email']) > 30);die();
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $err['email'] = "Invalid email format";
    }else if(isset($_POST['email']) && !empty($_POST['email'])){
      $email = $_POST['email'];
    }else{
      $err['email'] = "Email is Required";
    }

        // if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['tym'])){
        //   $err['tym'] = "Only Alphabets & Numbers allowed";
        // }else if(isset($_POST['tym']) && !empty($_POST['tym'])){
        //   $tym = $_POST['tym'];
        // }else{
        //   $err['tym'] = "Call Time is Required";
        // }

    if(isset($_POST['message']) && !empty($_POST['message'])){
      $message = $_POST['message'];
    }else{
      $err['message'] = "Message is Required";
    }

    if(isset($_POST['pid']) && !empty($_POST['pid'])){
      $pid = $_POST['pid'];
    }else{
      $err['pid'] = "Project Name is Required";
    }

    if(count($err) == 0){
      $projects = array(
        "527663903571816620"  =>"Prithvi" , 
        // "527663432578816955"  =>"Mystic" ,
        "527664231125816273" => "Prospera",
          // "527663903571816854" => "Princeville",
        "527663721401816891" => "Park Infinia",
          // "527663721401816999" => "Picasso" ,
        "527663903571816481" => "Princetown Tower",
        "527663903571816278" => "Princetown Royal",
        // "527663432578816202" => "Home",
        "540797986297839761" => "Prajwal",
        "537591453447839980" => "Palm Spring Tower",
        "529050893144816332" => "Siddhachal",
        "560338377402839217"  =>"Palm Spring Tower",
        "527922591991816127" => "Primavera",
        // "583492743235839735" => "47 East",
        "570166517982839433" => "Pratham",
        "614170064407839897" => "Peninsula",
        "621664737826839425" =>"Priyadarshan",
        "527664231125816158" => "Primus",
        "527664231125816009" => "Parasmani",
        "527921107052816529" => "Hill View Residency"
          // "527663432578816438" => "Springs",
        // "542697205146839813" => "Serenity",
        // "542697205146839434" => "Saffron" 
      );

      $honeypot=$_REQUEST['firstname'];
      if(empty($honeypot && $json->success==1)){

        $query = "INSERT INTO leads SET lead_name=:name, email=:email, mobile=:phone, service=:message, city=:pid";

        $stmt = $conn->prepare($query);
        $name = htmlspecialchars(strip_tags($name));
        $email = htmlspecialchars(strip_tags($email));
        $phone = htmlspecialchars(strip_tags($phone));
        $tym = htmlspecialchars(strip_tags($tym));
        $message = htmlspecialchars(strip_tags($message. " Calling Time:" . $tym));
        $pid = htmlspecialchars(strip_tags($pid));
        $campaign = "KP_Digital";
        $source = "KP_WebSite";
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":tym", $tym);
        $stmt->bindParam(":message", $message);


          // var_dump($projects[$project_name]);die();
        $stmt->bindParam(":pid", $projects[$pid]);
        $stmt->bindParam(":campaign", $campaign);
        $stmt->bindParam(":source", $source);
        if($stmt->execute()){
          //   return true;

          $project = $projects[$pid];
          $wuid= '527748409256816694_ws_527660047398816469';
          $uid= '527660047398816469';
          $campaign= 'KP_Digital';
          $source= 'KP_WebSite';
          $PopUp='';

            // $RQurl = 'http://api.realtyredefined.in/rqLeadAPI.php?wuid=' . $wuid . '&name=' . urlencode($name) . '&mobile=' . urlencode($phone) . '&email=' . urlencode($email) . '&Source=' . urlencode($source) . '&Message=' . urlencode($message) . '&Campaign=' . $campaign . '&pid=' . $pid . '&uid=' . $uid;

            //  $RQch = curl_init();
            //   curl_setopt($RQch, CURLOPT_URL, $RQurl);
            //   curl_setopt($RQch, CURLOPT_HEADER, 0);
            //   curl_setopt($RQch, CURLOPT_RETURNTRANSFER);
            //   $RQresult = curl_exec($RQch);
            //   var_dump($RQresult);die();
            //   curl_close($RQch);


            // ----------------------Qudra Integreation Start-------------
          $post = array (
            'Name'=> $name,
            'Email'=>$email,
            'Phone'=>$phone,
            'Remarks'=>$PopUp,
            'Project'=>$project,
            'LandingPage'=>$utm_Url,
            'Referral'=>$source,
            'Utm_Source'=>$utmSource,
            'Utm_Medium'=>$utmMedium,
            'Utm_Campaign'=>$utmCampaign,
            'Country'=>$country
          );
          $qString=http_build_query($post);
                // echo "<pre>";
                // print_r($qString);
                // echo "<pre>";
                // var_dump($qString);
                // $RQurl = 'https://quadraleads.in/QleadsKW/EnquiryModule/Common/EnquiryToExternalSource?Name='.$name.'&Email='.$email.'&Phone='.$mobile.'&Remarks='.$PopUp.'&Project='.$proj.'&LandingPage='.$siteUrl.'&Referral='.$source.'&Utm_Source='.$utmSource.'&Utm_Medium='.$utmMedium.'&Utm_Campaign='.$utmCampaign.'&Country='.$country;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,"https://quadraleads.in/QleadsKW/EnquiryModule/Common/EnquiryToExternalSource");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_HEADER,true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER);
          $resp = trim(curl_exec($ch));
                // $resp = curl_exec($ch);
          $json = json_decode($resp);

          if ($e = curl_error($ch)) {
            echo $e;
          }
          else{
            $decoded = json_decode($resp);
                    // print_r($resp);
                    // echo "<pre>";
                    // print_r($decoded);
                    // echo "<pre>";
                    // var_dump($decoded);
            $encoded = json_encode($decoded,true);
                    // var_dump  ($encoded);

                    // foreach ($decoded as $key => $value) {
                    // echo $key .':'.$value.'<br>';
                    //     }
          }
          curl_close ($ch);
            // ----------------------Qudra Integreation End-------------

              //email

          $to = "hemraj.wagh@kumarworld.com" ;

          $subject = "Kumar Properties Enquiry - " .$project; 

          $body  .= '<html><body>';
          $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';    
          $body .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" .$name. "</td></tr>";
          $body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
          $body .= "<tr><td><strong>Phone:</strong> </td><td>" .  $phone. "</td></tr>";
          $body .= "<tr><td><strong>Calling Time:</strong> </td><td>" .  $tym. "</td></tr>";
          $body .= "<tr><td><strong>Message:</strong> </td><td>" . $message. "</td></tr>";
          $body .= "<tr><td><strong>Project:</strong> </td><td>"  .$project. "</td></tr>";
                // $body .= "<tr><td><strong>Source:</strong> </td><td>" .$project. "</td></tr>";
          $body .= "<tr><td><strong>UTM Source:</strong> </td><td> ".$utmSource."</td></tr>";
          $body .= "<tr><td><strong>Campaign Medium:</strong> </td><td> ".$utmMedium."</td></tr>";
          $body .= "<tr><td><strong>Campaign Name:</strong> </td><td> ".$utmCampaign."</td></tr>";
          $body .= "</table>";
          $body .= "</body></html>";

          $headers = "From: kumarworld Enquiry \r\n";
                //$headers .='X-Mailer: PHP/' . phpversion();
                     //$headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $send = mail($to, $subject, $body, $headers);

          header('Location: /2-3-bhk-flats-pune/thank-you.php');
        }
            // -----------End if($stmt) ---------
        else{
          return false;
        }

      }
    }
    else{
      $_SESSION['errors'] = $err;
      $_SESSION['postval'] = $_POST;
      header('Location: enquiry_form.php');
    }
        // --------------End if(honypot)----------
    function validate_phone_number($phone)
    {    
     if (strlen($phone) <= 10) {
      return true;
    } else {
     return false;
   }
 }

 if(isset($_COOKIE['__gtm_campaign_url'])){
  unset($_COOKIE['__gtm_campaign_url']);    
}
        // function validate_email($email)
        // {    
        //    if (strlen($email) <= 30) {
        //       return true;
        //    } else {
        //      return false;
        //    }
        // }

?>