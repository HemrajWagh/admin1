<?php
include_once 'database.php';



if (isset($_POST['submit'])){
	$name = $_POST['name'];
	$contactno = $_POST['contactno'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$location = $_POST['location'];
	$dob = $_POST['dob'];
	$status = $_POST['status'];
	$occupation = $_POST['occupation'];
	$companyname = $_POST['companyname'];
	$typeofcompany = $_POST['typeofcompany'];
	$interestedinbuying = $_POST['interestedinbuying'];
	$typeofbuyer = $_POST['typeofbuyer'];
	$typeofflat = $_POST['typeofflat'];
	$approxbudget = $_POST['approxbudget'];
	$enquirysource = $_POST['enquirysource'];
	$otp = $_POST['otp'];



$sql="insert into feedback1(name,contactno,email,city,location,dob,status,occupation,companyname,typeofcompany,interestedinbuying,typeofbuyer,typeofflat,approxbudget,enquirysource,otp) values('$name','$contactno','$email','$city','$location','$dob','$status','$occupation','$companyname','$typeofcompany','$interestedinbuying','$typeofbuyer','$typeofflat','$approxbudget','$enquirysource','$otp')";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

?>