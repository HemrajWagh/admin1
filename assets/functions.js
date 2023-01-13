
  $(document).ready(function() {
	    var params = new window.URLSearchParams(window.location.search);
	    if(params.get('visit') != null){
	      $("#datefilters").addClass('collapse in');
	    }
	    $('#enqtable').DataTable();
	});

  function Feedback(len)
  {
    var email = $("#feedbtn"+len).attr('data-email');
    $.ajax({
      url:'model.php',
      data:{
        'functioncall':'feedback',
        'email':email
      },
      type:'GET',
      contentType: 'application/json',
      dataType: "json",
      success:function(res){
        $("#feedbckdiv").empty();
        if(res == 'nodata'){
          $("#feedbckdiv").html('<p><strong>No Data Found !</strong></p>')
        }else{
          html = '<p><strong>Service at Reception: </strong><span id="reception_feed">'+res.service_at_reception+' star</span></p>'+
                    '<p><strong>Show-Flat Experience: </strong> <span id="flat_exp_feed">'+res.show_flat_experience+' star</span></p>'+
                    '<p><strong>Site Visit Experience: </strong> <span id="visit_exp_feed">'+res.site_visit_experience +' star</span></p>'+
                    '<p><strong>Sales Person Experience: </strong> <span id="sp_exp_feed">'+res.sales_person_experience+' star</span></p>'+
                    '<p><strong>Suggestion for Improvements: </strong> <span id="suggestion_feed">'+res.suggestion_for_improvements+'</span></p>';
          $("#feedbckdiv").html(html);
        }
      }

    });
  }

  function Filters()
  {
    $("#visitErr, #todateErr,#fromdateErr").empty();
    var visit,todate,fromdate;
    visit = $('input[name="visit"]:checked').val();
    todate = $('#to_date').val();
    fromdate = $('#from_date').val();

    if(visit == undefined){
      $("#visitErr").append("Visit field required");
    }

    if(todate == ""){
      $("#todateErr").append("To date field required");
    }

     if(fromdate == ""){
      $("#fromdateErr").append("From date field required");
    }
    // var url = window.origin 
    window.location.href = 'dashboard?visit='+visit+'&todate='+todate+'&fromdate='+fromdate+'';
  }

function Add()
{          
  $.ajax({
    url: 'model.php',
    dataType : 'json',
    data :{
      'functioncall':'add',
      'name' : $("#name").val()
    },
    type : 'POST',
    success: function(data){      
      if(data == "success"){
        window.location.href = "dashboard.php";
      }else if(data == "error"){
          $("#invalid").append("Something Went Wrong");
      }else{
        if(data.name != undefined){
          $("#nameErr").append(data.name);
        }       
      }
    }
  });
}

function ShowData(len){
  var id = $("#assign"+len).data('id');
  $("#id").val(id);
  $.ajax({
    url:'model.php',
    data:{
      'id':id,
      'functioncall':'get'
    },
    dataType:'json',
    type : 'GET',
    success:function(res){
      $('#assigned_to option[value="'+res.assigned_id+'"]').attr("selected", "selected");
      $("#comments").val(res.comments);
    },
  })
}

function UpdateAssigned()
{     
  $.ajax({
    url: 'model.php',
    dataType : 'json',
    data :{
      'functioncall':'updateassigned',
      'id':$("#id").val(),
      'assigned_to':$("#assigned_to").val(),
      'comments':$("#comments").val()
    },
    type : 'POST',
    success: function(data){ 
      $("#AssignErr, #invalid, #CommentsErr").empty();     
      if(data == "success"){
        window.location.href = "dashboard.php";
      }else if(data == "error"){
          $("#invalid").append("Something Went Wrong");
      }else{
        if(data.assigned_to != undefined){
          $("#AssignErr").append(data.assigned_to);
        }  

        if(data.comments != undefined){
          $("#CommentsErr").append(data.comments);
        }     
      }
    }
  });
}
