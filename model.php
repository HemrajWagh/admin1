<?php
	include 'include/database.php';
	// var_dump($conn);die();
	session_start();
	header('Content-Type: application/json');
	if(isset($_REQUEST['functioncall']) && !empty($_REQUEST['functioncall'])) {
	    $function2call = $_REQUEST['functioncall'];
	    switch($function2call) {
	        case 'login' 		: login();
	        	break;
	        case 'logout' 		: Logout();
	        	break;
	        case 'profile' 		: Profile();
	        	break;	  
	        case 'revisit' 		: Revisit();
	        	break;	 
	        case 'feedback' 	: GetFeedback();
	        	break;
	        case 'add' 			: AddUser();
	        	break;
	        case 'updateassigned': UpdateAssignedUser();
				break;
			case 'get'			: getData();
				break;	    
	    }

	}

	function login()
	{
		global $conn;
		$errors = [];$email = $password="";
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = $_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $errors['email'] = "Enter Valid Email Address";
			}
		}else{
			$errors['email'] = "Email Field is Required"; 
		}

		if(isset($_POST['password']) && !empty($_POST['password'])){
			$password = $_POST['password'];
		}else{
			$errors['password'] = "Password Field is Required"; 
		}

		if(empty($errors)){
			$sql = "SELECT * FROM login_admin WHERE user_name='".$email."' AND user_pass='".sha1($password)."'";
			
			$result = mysqli_query($conn,$sql);
			$data = mysqli_fetch_assoc($result);
		
			if($data){
				$_SESSION['name'] = $data['name'];
				$_SESSION['id'] = $data['id'];
				$_SESSION['email'] = $data['user_name'];
				$_SESSION['is_login'] = true;
				echo json_encode('success');
			}else{
				echo json_encode('invalid');
			}
		}else{
			echo json_encode($errors);
		}
	}

	function GetFeedback()
	{
		global $conn;
		$email = $_REQUEST['email'];
		$query = "SELECT * FROM feedback1 WHERE email ='".$email."'";
		$res = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($res);
		if($row){
			echo json_encode($row);
		}else{
			echo json_encode("nodata");
		}
		
	}

	function Logout()
	{
		session_start();
		if($_SESSION['is_login']){
			session_destroy();
		    unset($_SESSION['name']);
		    unset($_SESSION['email']);
		    header('location:login.php');
		}
	}

	function Profile()
	{
		global $conn;
		$errors = [];$data = [];
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$data['name'] = $_POST['name'];
		}else{
			$errors['name'] = "Name Field is Required"; 
		}

		if(isset($_POST['email']) && !empty($_POST['email'])){
			$data['email'] = $_POST['email'];
			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			  $errors['email'] = "Enter Valid Email Address";
			}
		}else{
			$errors['email'] = "Email Field is Required"; 
		}
		

		if(isset($_POST['password']) && !empty($_POST['password'])){
			$data['password'] = $_POST['password'];
		}else{
			$data['password'] = ""; 
		}

		$data['id'] = $_POST['id'];

		if(empty($errors)){
			if($data['password'] != ""){
				$sql = "UPDATE login_admin SET name = '".$data['name']."',user_pass='".sha1($data['password'])."',user_name = '".$data['email']."' where id=".$data['id']."";	
			}else{
				$sql = "UPDATE login_admin SET name = '".$data['name']."',user_name = '".$data['email']."' where id=".$data['id']."";	
			}
					
			if(mysqli_query($conn, $sql)){
				echo json_encode('success');
			}else{
				echo json_encode('error'.mysqli_error($conn));
			}
		}else{
			echo json_encode($errors);
		}
	}

	function Revisit()
	{
		global $conn;
		$errors = [];$mobile_no ="";

		if(isset($_POST['mobile_no']) && !empty($_POST['mobile_no'])){
			$mobile_no = $_POST['mobile_no'];
		}else{
			$errors['contactno'] = "Mobile No Field is Required"; 
		}

		if(isset($_POST['revisit_to']) && !empty($_POST['revisit_to'])){
			$revisit_to = $_POST['revisit_to'];
		}else{
			$errors['revisit_to'] = "revisit_to No Field is Required"; 
		}

		// echo "<pre>";
		// print_r($_REQUEST['revisit_to']);
		// echo "<pre>";
			
		if(empty($errors)){
		$digitalsubsource = $_POST["digitalsubsource"];
		$channelsubsource = $_POST["channelsubsource"];
		$referralname= $_POST["referralname"];
		$referralprojectname= $_POST["referralprojectname"];
		$referralbuildingname= $_POST["referralbuildingname"];
		$referralflatno= $_POST["referralflatno"];
			$sql = "SELECT name,email,contactno,enquirysource,digitalsubsource,firmname,referralname,referralprojectname,referralbuildingname,referralflatno,revisit_to FROM enquiry WHERE contactno =".$mobile_no."";
			// var_dump($sql);
			// if ($conn->query($sql) === TRUE) {
			//   echo "New record created successfully";
			// } else {
			//   echo "Error: " . $sql . "<br>" . $conn->error;
			// }
			$result = mysqli_query($conn,$sql);
			$data = mysqli_fetch_assoc($result);


			if($data){
				$params = [];
				
				$exp = explode("~", $data['enquirysource']);
				$params =[
					'name' 		=> 	$data['name'],
					'email'		=>	$data['email'],
					'contactno'	=>	$data['contactno'],
					'revisit_to'=>	$data['revisit_to'],
					'source'	=>	$exp[0],
					'campaign'	=>	$exp[1]
				];

				$query = "UPDATE enquiry SET revisit_to = '".$revisit_to."',visits = visits + 1 where contactno = '".$mobile_no."'";
						// "UPDATE login_admin SET name = '".$data['name']."',user_name = '".$data['email']."' where id=".$data['id'].""
				if(mysqli_query($conn,$query)){
					 $params['form_id']	=  $last_id;
				    $res_rcube = rcube($params);
					echo json_encode('success');
				}
				
			}else{
				echo json_encode('invalid');
			}
		}else{
			echo json_encode($errors);
		}
	}

function rcube($data)
{

	$name=$data['name'];
	$email=$data['email'];
	$contactno=$data['contactno'];
	// $enquirysource=$data['source'];
	// $digitalsubsource=$data['campaign'];

	$message="Enquiry form lead. Formid - Form_ID_".$data['form_id']." ";


                                                                                                                                                                                                                                                   ;
	$source = $data['source'];//$_REQUEST['Source'];

	  	                                                                                  
	$wuid='527748409256816694_ws_527660047398816469';
	$uid='527660047398816469';
	$campaign= $data['campaign'];

	$RQurl = 'http://api.realtyredefined.in/rqLeadApi_v2.php?wuid='.$wuid.'&name='.urlencode($name).'&mobile='.urlencode($contactno).'&email='.urlencode($email).'&Source='.urlencode($source).'&Message='.urlencode($message).'&Campaign='.urlencode($campaign).'&token=977u3zb4vtlp2rfn';

	// echo $RQurl;

	$RQch = curl_init();
        curl_setopt($RQch, CURLOPT_URL, $RQurl);
        curl_setopt($RQch, CURLOPT_TIMEOUT, 1); 
        curl_setopt($RQch, CURLOPT_HEADER, 0);
        curl_setopt($RQch,  CURLOPT_RETURNTRANSFER, false);
        curl_setopt($RQch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($RQch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($RQch, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
        curl_setopt($RQch, CURLOPT_FRESH_CONNECT, true);
        $RQresult = curl_exec($RQch);
        curl_close($ch);
        return $RQresult;
}

function AddUser()
{
	// var_dump($_POST['name']);die();
	global $conn;
		$errors = [];$data = [];

		if(isset($_POST['name']) && !empty($_POST['name'])){
			$data['name'] = $_POST['name'];
		}else{
			$errors['name'] = "Name Field is Required"; 
		}

		if(empty($errors)){			
			$sql = "INSERT into users (name) VALUES ('".$data['name']."')";						
			if(mysqli_query($conn, $sql)){
				echo json_encode('success');
			}else{
				echo json_encode('error'.mysqli_error($conn));
			}
		}else{
			echo json_encode($errors);
		}
}

function UpdateAssignedUser()
{
	global $conn;
	$errors = [];$data = [];
	if(isset($_POST['assigned_to']) && !empty($_POST['assigned_to'])){
		$data['assigned_to'] = $_POST['assigned_to'];
	}else{
		$errors['assigned_to'] = "Assigned To Field is Required"; 
	}

	if(isset($_POST['comments']) && !empty($_POST['comments'])){
		$data['comments'] = $_POST['comments'];
	}else{
		$errors['comments'] = "Comments Field is Required"; 
	}
	
	$data['id'] = $_POST['id'];
// var_dump($data['id']);die();
	if(empty($errors)){
		$sql = "UPDATE enquiry SET assigned_id = '".$data['assigned_to']."',comments = '".$data['comments']."' where id='".$data['id']."'";	
				
		if(mysqli_query($conn, $sql)){
			echo json_encode('success');
		}else{
			echo json_encode('error '.mysqli_error($conn));
		}
	}else{
		echo json_encode($errors);
	}
}

function getData(){
	global $conn;
	$id = $_REQUEST['id'];
	// var_dump($id);die();
	$sql = "SELECT users.name,enquiry.comments,enquiry.assigned_id FROM enquiry LEFT JOIN users ON enquiry.assigned_id = users.id WHERE enquiry.id ='".$id."'";
	$result = mysqli_query($conn,$sql);
	$data = mysqli_fetch_assoc($result);
	// var_dump($data);die();
 	echo json_encode($data);
}
?>