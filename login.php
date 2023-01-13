<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin-Login</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<style>
    body {
        /*background-color: #337ab7;*/
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
        background-attachment: fixed;
        }

        *[role="form"] {
            max-width: 1100px;
            padding: 15px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 0.3em;
            background-size: cover;
        background-position: 50% 50%;
        background-attachment: fixed;
        }

        *[role="form"] h2 {
            margin-left: 5em;
            margin-bottom: 1em;
        }
    .col-md-6.enq-form img {
        width: 30%;
        float: left;
        padding-left: 25PX;

    }

    input[type=text], select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
  } 
    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }
    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

   /* .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }*/

    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }

    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }
    .row{
      margin-top: 155px;
    }

    @media screen and (max-width: 600px) {
      .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
  }

</style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
        <div class="col-md-6 enq-form">
        <form class="form-horizontal" id="login_form" method="POST">
          <input type="hidden" name="functioncall" value="login">
          <div >
            <!-- <img src="../images/Kumar Logo_300 x 72.png" > -->
            <div class="a"><h3 style="text-align:end;">Admin Login</h3>
                <hr size="40" shade> 
            </div>
          </div>
          <div class="form-group">
              <label for="email" class="col-sm-3 control-label"> E-mail:</label>
              <div class="col-sm-9">
                  <input type="text" id="email" name="email" placeholder="Email Address" class="form-control">
                  <span id="emailerr" class="text-danger"></span>
              </div>
          </div>
                       
          <div class="form-group">
              <label for="password" class="col-sm-3 control-label">Password:</label>
              <div class="col-sm-9">
                  <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                  <span id="passworderr" class="text-danger"></span>
              </div>
              
          </div>

          <div class="form-group">
            <div class="col-md-6"></div>
             <div class="col-md-6">
              <a href="javascript:void(0)" class="btn btn-success pull-right" onclick="Login()">Login</a>
            </div>
          </div>
      </form>
    </div>
    </div>
    
  </div>
</body>

<script type="text/javascript">
  function Login()
  {
      $.ajax({
        url: 'model.php',
        dataType : 'json',
        data :$("#login_form").serializeArray(),
        type : 'POST',
        success: function(data){
          $("#emailerr").empty();
          $("#passworderr").empty();
          if(data == "success"){
            window.location.href = "dashboard.php";
          }else if(data == "invalid"){
            $("#passworderr").append("Invalid Credentials !");
          }else{
            if(data.email != ""){
              $("#emailerr").append(data.email);
            }

            if(data.password != ""){
              $("#passworderr").append(data.password);
            }
          }
          
        }
      });
  }
</script>


</html>