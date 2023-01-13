
<!DOCTYPE html>
<html>
<?php

  include 'include/database.php';
if(count($_POST)>0) {
mysqli_query($conn,"UPDATE  enquiry set id='" . $_POST['id'] . "', name='" . $_POST['name'] . "' WHERE id='" . $_POST['id'] . "'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM enquiry WHERE id='" . $_GET['id'] . "'");
$enquiry= mysqli_fetch_array($result);

?>
<head>
  <title>User Details</title>
  <meta charset="UTF-8">
</head>
<body>


<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>







<style>
    body {
  /*background-color: #337ab7;*/
      background-repeat: no-repeat;
    background-size: cover;
    background-position: 50% 50%;
    background-attachment: fixed;
    }

    *[role="form"] {
        box-shadow: 0 20px 44px rgb(0 0 0 / 20%), 0 0 5px rgb(0 0 0 / 20%);
        max-width: 1100px;
        padding: 15px;
        margin: 0 auto;

        background-color: #c3c3c3;
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
    width: 25%;
    float: left;
    padding-left: 25PX;

}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  background-color: #c3c3c3;
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

.container {
  border-radius: 5px;
  /*background-color: #c3c3c3;*/
  padding: 20px;
}

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

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
.existno{color:#c31a1a;}
</style>
<br>


   
<div class="container">
    <div class="col-md-3">  




    </div>

    <div class="col-md-6 enq-form">
        
  <form method="post" action="" class="form-horizontal" role="form" >
   
<div class="form-group">
            <!-- <img src="../images/Kumar Logo_300 x 72.png"> -->
            <div class="a">
                <h3 style="text-align:center;"><img src="../images/Kumar Logo_300 x 72.png">User Details  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    <a style="text-align:center;color: #c3c3c3; background-color: #ED7D2F;box-shadow: 0 20px 44px rgb(0 0 0 / 41%), 0 0 30px rgb(0 0 0 / 20%);" href="dashboard.php" class="btn btn-primary" role="button">Go Back</a>
                </h3>
                <hr size="40" shade> 
            </div>
</div>
 <input type="hidden" name="userid" class="txtField" value="<?php echo $row['userid']; ?>">

            <div class="form-group">
                <label for="Name" class="col-sm-3 control-label"> Name:</label>
                <div class="col-sm-9">
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $enquiry['name'] ?>"readonly>
               </div>
               </div>
          
            <div class="form-group">
                <label for="contactno" class="col-sm-3 control-label">Contact No:</label>
                <div class="col-sm-9">
                    <input type="text" id="contactno" name="contactno"  class="form-control" value="<?php echo $enquiry['contactno'] ?>"readonly >
            
                </div>
                            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">E-mail:</label>
                <div class="col-sm-9">
                    <input type="email" id="email" name="email"  class="form-control" value="<?php echo $enquiry['email'] ?>"readonly>
                  
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-3 control-label">City:</label>
                <div class="col-sm-9">
                    <input type="text" id="city" name="city"  class="form-control" value="<?php echo $enquiry['city'] ?>"readonly >
                   
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-3 control-label">Location:</label>
                <div class="col-sm-9">
                 <input type="text" id="location" name="location" placeholder="Location" class="form-control" value="<?php echo $enquiry['location'] ?>"readonly >
            
             </div>


         </div>
           <div class="form-group">
                <label for="dob" class="col-sm-3 control-label">DOB:</label>
                <div class="col-sm-9">
                 <input type="text" id="dob" name="dob" class="form-control" value="<?php echo $enquiry['dob'] ?>" readonly>
            
             </div>
           </div>
             <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Status:</label>
                <div class="col-sm-9">
                 <input type="text" id="status" name="status"  class="form-control" value="<?php echo $enquiry['status'] ?>" readonly>
            
             </div>


         </div>


 <div class="form-group">
                <label for="occupation" class="col-sm-3 control-label">Occupation:</label>
                <div class="col-sm-9">
                 <input type="text" id="occupation" name="occupation"  class="form-control" value="<?php echo $enquiry['occupation'] ?>"readonly >
            
             </div>


         </div>


 <div class="form-group">
                <label for="companyname" class="col-sm-3 control-label">Company name:</label>
                <div class="col-sm-9">
                 <input type="text" id="companyname" name="companyname"  class="form-control" value="<?php echo $enquiry['companyname'] ?>"readonly >
            
             </div>


         </div>


 <div class="form-group">
                <label for="typeofcompany" class="col-sm-3 control-label">Type of company:</label>
                <div class="col-sm-9">
                 <input type="text" id="typeofcompany" name="typeofcompany" class="form-control" value="<?php echo $enquiry['typeofcompany'] ?>"readonly >
            
             </div>


         </div>


 <div class="form-group">
                <label for="interestedinbuying" class="col-sm-3 control-label">Interested inbuying:</label>
                <div class="col-sm-9">
                 <input type="text" id="interestedinbuying" name="interestedinbuying"  class="form-control" value="<?php echo $enquiry['interestedinbuying'] ?>" readonly>
            
             </div>


         </div>


 <div class="form-group">
                <label for="typeofbuyer" class="col-sm-3 control-label">Type of buyer:</label>
                <div class="col-sm-9">
                 <input type="text" id="typeofbuyer" name="typeofbuyer"  class="form-control" value="<?php echo $enquiry['typeofbuyer'] ?>" readonly >
            
             </div>


         </div>


 <div class="form-group">
                <label for="typeofflat" class="col-sm-3 control-label">Type of flat:</label>
                <div class="col-sm-9">
                 <input type="text" id="typeofflat" name="typeofflat"  class="form-control" value="<?php echo $enquiry['typeofflat'] ?>"readonly >
            
             </div>


         </div>


 <div class="form-group">
                <label for="approx budget" class="col-sm-3 control-label">Approx budget:</label>
                <div class="col-sm-9">
                 <input type="text" id="approxbudget" name="approxbudget"  class="form-control" value="<?php echo $enquiry['approxbudget'] ?>"readonly >
            
             </div>


         </div>
         <?php 
$subsource1=explode('~',$enquiry['enquirysource']);
 ?>

          <div class="form-group">
                <label for="enquirysource" class="col-sm-3 control-label">Enquiry source:</label>
                <div class="col-sm-9">
                 <input type="text" id="enquirysource" name="enquirysource"  class="form-control" value="<?php echo $subsource1[0]; ?>"   readonly>
            
             </div>


         </div>
          <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Register date:</label>
                <div class="col-sm-9">
                 <input type="text" id="registerdate" name="registerdate"  class="form-control" value="<?php echo $enquiry['registerdate'] ?>"   readonly>
            
             </div>
           </div>

<?php 
$subsource=explode('~',$enquiry['digitalsubsource']);
 ?>
         <div class="form-group">
                <label for="digitalsubsource" class="col-sm-3 control-label">Digital subsource:</label>
                <div class="col-sm-9">
                 <input type="text" id="digitalsubsource" name="digitalsubsource" class="form-control" value="<?php echo $subsource[0]; ?>"   readonly>
            
             </div>


         </div>
        

       
         <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Firm Name:</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="channelsubsource"  class="form-control" value="<?php echo $enquiry['channelsubsource'] ?>"   readonly>
            
             </div>
           </div>
		    <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Exceutive name :</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="exceutivename"  class="form-control" value="<?php echo $enquiry['exceutivename'] ?>"   readonly>
            
             </div>
           </div>
		   <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Exceutive number:</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="exceutivenumber"  class="form-control" value="<?php echo $enquiry['exceutivenumber'] ?>"   readonly>
            
             </div>
           </div>
		   <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Existing Client Name:</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="existingclientname"  class="form-control" value="<?php echo $enquiry['existingclientname'] ?>"   readonly>
            
             </div>
           </div>
		    <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Cluster:</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="cluster"  class="form-control" value="<?php echo $enquiry['cluster'] ?>"   readonly>
            
             </div>
           </div>
		   <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Tower:</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="Tower"  class="form-control" value="<?php echo $enquiry['Tower'] ?>"   readonly>
            
             </div>
           </div>
		   <div class="form-group">
                <label for="channelsubsource" class="col-sm-3 control-label">Flat no:</label>
                <div class="col-sm-9">
                 <input type="text" id="channelsubsource" name="flatno"  class="form-control" value="<?php echo $enquiry['flatno'] ?>"   readonly>
            
             </div>
           </div>


  



             <div class="form-group">
                <label for=" Referral Name" class="col-sm-3 control-label">Referral Name:</label>
                <div class="col-sm-9">
                 <input type="text" id="referralname" name="referralname"  class="form-control" value="<?php echo $enquiry['referralname'] ?>"   readonly>
            
             </div>
           </div>
           <div class="form-group">
                <label for=" project Name" class="col-sm-3 control-label">Referral Project Name:</label>
                <div class="col-sm-9">
                 <input type="text" id="referralprojectname" name="referralprojectname"  class="form-control" value="<?php echo $enquiry['referralprojectname'] ?>"   readonly>
            
             </div>
           </div>
           <div class="form-group">
                <label for="building Name" class="col-sm-3 control-label"> Referral Building Name:</label>
                <div class="col-sm-9">
                 <input type="text" id="referralbuildingname" name="referralbuildingname"class="form-control" value="<?php echo $enquiry['referralbuildingname'] ?>"   readonly>
            
             </div>
           </div>
           <div class="form-group">
                <label for="Referral flat no" class="col-sm-3 control-label">Referral flat no:</label>
                <div class="col-sm-9">
                 <input type="text" id="referralflatno" name="referralflatno" class="form-control" value="<?php echo $enquiry['referralflatno'] ?>"   readonly>
            
             </div>
           </div>
        



 























          </div>
</div>
<!-- /.form-group -->



          

  </div>
 
</form>
</div></div>

 
<!-- /form -->
        <!-- ./container -->



   </body>
 
</html>
