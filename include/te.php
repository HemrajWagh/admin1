<?php
include_once 'database.php';
if(isset($_POST['save']))
{	 
	$name = $_POST['name'];
	$contactno = $_POST['contactno'];
	$email = $_POST['email'];
	$city = $_POST['city'];

	$location = $_POST['location'];
	$dob = $_POST['dob'];
	$status	 = $_POST['status'];
	$occupation = $_POST['occupation'];
	$companyname = $_POST['companyname'];
	$typeofcompany		 = $_POST['typeofcompany'];
	$interestedinbuying = $_POST['interestedinbuying'];
	$sql = "INSERT INTO t (name,contactno,email,city,location,dob,status,occupation,companyname,typeofcompany,interestedinbuying)
	VALUES ('$name','$contactno,','$email','$city','$location','$dob','$status','$occupation','$companyname','$typeofcompany','$interestedinbuying')";
	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	} else {
		echo "Error: " . $sql . "
		" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>