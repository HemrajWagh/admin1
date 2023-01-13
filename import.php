


<?php

$servername='localhost';
$username='root';
$password='';
$dbname = "feedback";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
   die('Could not Connect My Sql:' .mysql_error());
}

$csvfile = $_FILES['csvfile']['name'];

$ext = pathinfo($csvfile, PATHINFO_EXTENSION);

$base_name = pathinfo($csvfile, PATHINFO_BASENAME);

if (isset($_POST['submit'])) {
    


if(!$_FILES['csvfile']['name'] == "")
    
{ 

if($ext == "csv")
{


 if(file_exists($base_name))
{

      echo "file already exist" . $base_name;
                                                  
}

    else
{
      
if (is_uploaded_file($_FILES['csvfile']['tmp_name'])) 

{

  echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";

  //readfile($_FILES['csvfile']['tmp_name']);
                                                            }
$handle = fopen($_FILES['csvfile']['tmp_name'], "r");

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
{

	$sql = "SELECT id FROM users WHERE name = '".$data[9]."'";
 	$get_id = mysqli_query($conn,$sql);
  	$assigned_id = mysqli_fetch_assoc($get_id);
      // var_dump($assigned_id['id']);die();     
	$import="INSERT INTO enquiry(name,contactno,email,city,location,typeofflat,approxbudget,enquirysource,registerdate,assigned_id,comments)
VALUES('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$assigned_id['id']."','".$data[10]."')";     
	mysqli_query($conn,$import); 
  }

  fclose($handle);
   echo "Import done";
}

}

else
{

 echo "  data not imported Check Extension Please save your with csv extension.  your current extension is ." . $ext ;
       
 }

}  

else
{
 echo "Please Upload File";
 }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>import</title>
</head>
<style>
 body {
  background-color: #337ab7;
  }
</style>
<body>


<center>

<form method="post" enctype="multipart/form-data">

<table>

<tr>

<td>Upload CSV File Here:-  </td><td><input type="file" value="Upload CSV Format" name="csvfile" />

<input type="submit" value="Upload" name="submit" /></td>

</tr>

</table>

</form>

</center>
</body>
</html>