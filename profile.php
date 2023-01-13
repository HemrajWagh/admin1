<?php
session_start();
if(!$_SESSION['is_login']){
    header('Location:login.php');
}
include 'include/database.php';  

?>
<!DOCTYPE html>
<html>
<head>
  <title>Kumar | Admin-Login</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="dashboard.php">Kumar Properties</a>
    </div>
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings
            <span class="caret"></span></a>
            <ul class="dropdown-menu" style="min-width: 0px !important">
                <li><a href="#"><?php echo $_SESSION['name']; ?></a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="model.php?functioncall=logout">Logout</a></li>
            </ul>
        </li>

    </ul>
    
  </div>
</nav>
  <div class="container">
    <h3 class="text-center">Welcome To Admin Panel</h3>
    <h4 class="text-center">Profile Update.</h4>
    
    <hr>
    <div class="row">
          <form id="profile_form" method="post">
            <input type="hidden" name="functioncall" value="profile">
            <input type="hidden" name="id" value="<?php if(!empty($_SESSION['id'])){ echo $_SESSION['id'];} ?>">
            <div class="row form-group">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <label class="form-input">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" value="<?php if(!empty($_SESSION['name'])){ echo $_SESSION['name'];} ?>">
                    <span id="name_err" class="text-danger"></span>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <label class="form-input">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email Address" value="<?php if(!empty($_SESSION['email'])){ echo $_SESSION['email'];} ?>">
                    <span id="email_err" class="text-danger"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <label class="form-input">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <button class="btn btn-default" type="button" onclick="window.history.back();">Cancel</button>
                    <button class="btn btn-primary" type="button" onclick="ProfileUpdate()">Update</button>
                </div>
            </div>
        </form>   
    </div>
  </div>
</body>
<script type="text/javascript">
  
function ProfileUpdate()
{          
  $.ajax({
    url: 'model.php',
    dataType : 'json',
    data :$("#profile_form").serializeArray(),
    type : 'POST',
    success: function(data){      
      if(data == "success"){
        window.location.href = "dashboard.php";
      }else if(data == "error"){
          $("#invalid").append("Something Went Wrong");
      }else{
        if(data.email != undefined){
          $("#email_err").append(data.email);
        }
        
        if(data.name != undefined){
          $("#name_err").append(data.name);
        }       
      }
    }
  });
}

</script>
</html>