<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/> -->
  <link rel="stylesheet" type="text/css" href="DataTables/DataTables/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.12.1/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="DataTables/Buttons-2.2.3/css/buttons.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="DataTables/DateTime-1.1.2/css/dataTables.dateTime.min.css"/>
  <link rel="stylesheet" type="text/css" href="DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="assets/style.css">


  <?php
// $start_time = microtime(true);
  session_start();
  if(!$_SESSION['is_login']){
    header('Location:login.php');
  }
  include 'include/database.php'; 



  function GetAllEnquiries()
  {
    global $conn;
    $data = [];
    $colname = "";
    if(isset($_REQUEST['visit']) && $_REQUEST['visit'] == 'new'){
      $colname = 'created_at';
    }else{
      $colname = 'updated_at';
    }

    if(isset($_REQUEST['visit']) && isset($_REQUEST['todate']) && isset($_REQUEST['fromdate'])){
      $query = "SELECT id,name,contactno,email,visits,enquirysource,created_at FROM enquiry WHERE $colname >= '".date('Y-m-d H:i:s',strtotime($_REQUEST['fromdate']))."' AND $colname <= '".date('Y-m-d H:i:s',strtotime($_REQUEST['todate']))."'";
      if($colname == 'updated_at'){
        $query .= " AND visits > 1 ORDER BY id desc";
      }else{
        $query .=" ORDER BY id desc";
      }

    }else{
    	
     $query = "SELECT id,lead_name,mobile,email,service,city,created_at FROM leads ORDER BY id desc";
   }
   $result = mysqli_query($conn,$query);


  //  if($result->num_rows > 0){
  //    while($row = $result->fetch_assoc()) {
  //     $data[] = $row;
  //   }
  // }

  return $data;
}
// $data = GetAllEnquiries();
// var_dump($data);


function TodaysCount()
{
  global $conn;
  $tcount = 0;
  $query = "SELECT COUNT(id) as count FROM enquiry WHERE DATE( created_at ) = DATE( NOW( ) )";
  $data = mysqli_query($conn,$query);
  $tcount = mysqli_fetch_assoc($data);
  return $tcount['count'];
}

function UsersList()
{
  global $conn;
  $data = [];
  $query = "SELECT id,name FROM users";
  $result = mysqli_query($conn,$query);
  if($result->num_rows > 0){
   while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}
return $data;
}
$data = GetAllEnquiries();
$tcount = TodaysCount();
$all_users = UsersList();
// var_dump($all_users);die();
if(isset($_REQUEST['functioncall'])){
  include 'model.php';
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin-Dashboard</title>
  <link href="./assets/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="./assets/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="shadowbtn">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="dashboard.php">Project</a>
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
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <!-- <h6 class="text-center"><strong>Hello!  </ strong>    <?php echo $_SESSION['name']; ?>  </h6> -->
          <h3 class="text-center"><strong>Hello!  </strong>    <?php echo $_SESSION['name']; ?>, Welcome To Admin Panel</h3>
          <!-- <h4 class="text-center">All Leads List.</h4> -->
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
              <h4>Total Leads : <?php echo count($data); ?></h4><br>

            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
              <h4 class="pull-right">Today's Leads : <?php echo $tcount; ?></h4>
            </div> 

          </div>

          <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
              <button type="button" class="btnNw btn-lg shadowbtn txtshadow pull-right"  data-toggle="collapse" data-target="#datefilters">Filters</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
              <div id="datefilters" class="collapse">
                <hr>
                <form method="GET" id="filter-form">
                  <div class="form-group">
                    <label class="control-label col-sm-3">Filter By:</label>
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="radio">
                            <label>
                              <input type="radio" name="visit" value="new" <?php if(isset($_GET['visit']) && $_GET['visit'] == 'new'){echo "checked";} ?>/>New Leads
                            </label>
                          </div>
                          <span id="visitErr" class="text-danger"></span>
                        </div>
                        <div class="col-sm-3">
                          <div class="radio">
                            <label>
                             <input type="radio" name="visit" value="re" <?php if(isset($_GET['visit']) && $_GET['visit'] == 're'){echo "checked";} ?>/>Contacted
                           </label>
                         </div>
                       </div>
                       <div class="col-sm-3">
                        <label>
                         <input type="text" placeholder="From Date" name="from_date" class="form-control" onfocusin="(this.type='date')" onfocusout="(this.type='text')" id="from_date" value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate']; } ?>" />
                         <span id="todateErr" class="text-danger"></span>
                       </label>
                     </div>
                     <div class="col-sm-3">
                      <label>
                       <input type="text" placeholder="To Date" name="to_date" class="form-control" onfocusin="(this.type='date')" onfocusout="(this.type='text')" id="to_date" value="<?php if(isset($_GET['todate'])){ echo $_GET['todate']; } ?>" />
                       <span id="fromdateErr" class="text-danger"></span>
                     </label>

                   </div>
                 </div>
                 <div class="row">
                  <div class="col-md-12">
                    <button type="button" class="btnNw btn-lg shadowbtn txtshadow pull-right" onclick="Filters()">Apply</button>
                  </div>
                </div>
              </div>
            </div>
          </form>


        </div>
      </div>
    </div>
    <hr> -->



      <!-- <a href='import.php' class="btn btn-primary pull-right">Import</a>  -->
       <!-- <a href='javascript:void(0)' class="btn btn-primary pull-right" style="margin-right: 5px;margin-bottom: 5px;" data-toggle="modal" data-target="#exampleModalCenter">Add User</a> -->

       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <table id="enqtable" class="table table-striped table-bordered hover mdl-data-table" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Lead No.</th>
                <th>Lead Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Service</th>
                <th>Register Date</th>
                <!-- <th>Source</th> -->
                <!-- <th>Visits</th> -->
                <!-- <th>Re-Visit to</th> -->
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              <?php 
              if(count($data) > 0){ 
                $no = 0;
                $expsource = "";
                foreach ($data as $enquiry) {
                  $no++;
                  // $expsource = explode("~", $enquiry['enquirysource']);
                  ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $enquiry['id']; ?></td>
                    <td><?php echo $enquiry['lead_name']; ?></td>
                    <td><?php echo $enquiry['mobile']; ?></td>
                    <td><?php echo $enquiry['email']; ?></td>
                    <td><?php echo $enquiry['service']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($enquiry['created_at'])); ?></td>
                    <!-- <td><?php if(isset($expsource) && isset($expsource[0])) {
                      echo $expsource[0];
                    } ?></td> -->
                    <!-- <td><?php echo $enquiry['visits']; ?></td> -->
                    <!-- <td><?php echo $enquiry['revisit_to']; ?></td> -->
                    <td>
                      <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#assigned_to_modal" id="assign<?php echo $no;?>" class="getid" data-length = "<?php echo $no;?>" data-id="<?php echo $enquiry['id']; ?>" onclick="ShowData(<?php echo $no;?>)"><i class="fa fa-user-plus" title="Assigned User & Comments"></i></a> -->
                      <!-- <a href="javascript:void(0)" data-email="<?php echo $enquiry['email']; ?>" data-toggle="modal" data-target="#feedback-modal" id="feedbtn<?php echo $no; ?>" onclick="Feedback('<?php echo $no; ?>')"><i class="fa fa-comments-o" title="Feedback"></i></a> -->
                      <!-- <a href='edit1.php?id=<?php echo $enquiry['id'];  ?>'><i class="fa fa-eye" title="Client Details"></i></a>                         -->
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

    <div id="feedback-modal" class="modal fade" role="dialog" data-backdrop="false">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Customer Feedback</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6" id="feedbckdiv">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal to add new user start here -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop='' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
              <form method="POST" id="add-user">
                <div class="form-group">
                  <label class="control-label col-sm-3">Name</label>
                  <div class="col-sm-12">
                    <input type="text" name="name" id="name" class="form-control" />
                    <span id="nameErr" class="text-danger"></span>
                  </div>
                </div>
              </form>
              <!-- </div> -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="Add()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- end here user modal -->


  <!-- Modal to Assigned User start here -->

  <!-- Modal -->
  <div class="modal fade" id="assigned_to_modal" tabindex="-1" role="dialog" data-backdrop='' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Assigned User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <form method="POST" id="assigne-user">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label class="control-label col-sm-3">Assigned To</label>
                <div class="col-sm-12">
                  <select class="form-control" name="assigned_to" id="assigned_to">
                    <option value="">Select Assigned To</option>
                    <?php 
                    foreach ($all_users as $user) {
                      ?>
                      <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <span id="AssignErr" class="text-danger"></span>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3">Comments</label>
                  <div class="col-sm-12">
                    <textarea class="form-control" name="comments" id="comments"></textarea>
                    <span id="CommentsErr" class="text-danger"></span>
                  </div>
                </div>
              </div>
            </form>
            <!-- </div> -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="UpdateAssigned()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- end here Assigned user modal -->

</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script> -->

<!-- <script type="text/javascript" src="./DataTables/datatables.min.js"></script> -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#enqtable').DataTable( 

    {
      dom: 'Bfrtip',
      buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    } );
  } );
</script>
<script type="text/javascript">
$(document).ready(function () {
    $('#enqtable').DataTable({
        autoWidth: false,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'mdc-data-table__cell',
            },
        ],
    });
});
</script>
<script type="text/javascript" src="DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="DataTables/Buttons-2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="DataTables/Buttons-2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="DataTables/Buttons-2.2.3/js/buttons.print.min.js"></script>
<script type="text/javascript" src="DataTables/DateTime-1.1.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
<!-- 
<script type="text/javascript">
  $('#enqtable').DataTable( {
      responsive: true
  } );
</script> -->
<script src="./assets/jquery.min.js"></script>
<script src="./assets/bootstrap.min.js"></script>
<script type="text/javascript" src="./assets/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/dataTables.bootstrap.min.js"></script>
<script src="./assets/functions.js"></script>


</body>
</html>