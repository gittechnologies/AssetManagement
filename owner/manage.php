<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 ?>
<?php include '../menu.php';?>
<script src="../js/ModalPopupWindow.js" type="text/javascript"></script>
<style>
    .dataTables_filter { display: none; }
    .dataTables_wrapper .dt-buttons {
        float:right;  
        text-align:center;
        font-size:12px;
    }
    .dataTables_paginate{
        font-size:10px;
        margin-bottom:5px;
    }
    .dataTables_length{
        font-size:12px;
        margin-bottom:5px;    
    }
    .dataTables_info{
        font-size:12px;
    }
</style>
<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Owner</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Owner</li>
     </ol>
      </div>
	 </div>
	 </div>
	 </div>
	 </div>
</section>

<section class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
    <div class="card">
     <div class="flash-message">
      <div class="row">
      
<div class="col-lg-6 col-md-6 col-xs-6" style="text-align:right"> 
 </div> 
</div>
   <div class="row">
          <div class="col-lg-12"><span id="success-msg"></div>
  </div>
<div class="card-body">
    <div class="row">
            <div class="col-lg-12">
                <a href="javascript:" onclick="addAction();" data-toggle="modal" data-target="#add-owner" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Add</a>              
            </div>
        </div>
 <div class="">
<table id="manageOwner" class="table table-bordered table-hover small">
 <thead>
  <tr>
    <th scope="col">Owner Name</th>
    <th scope="col">City</th>
    <th scope="col">Contact Number</th> 
    <th scope="col">Email</th> 
    <th scope="col">Action</th>
   </tr>
  </thead>
<tbody>
<?php   
  $result = $dbConn->query("SELECT o.owner_id, o.owner_name, 
(select c.name from cities c where c.id = o.city_id) as city, o.contact_number, o.email_id 
FROM det_owner o where status = 'Active'");
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {    
?>
<tr>
    
 
<?php
    echo "<td>".$row['owner_name']."</td>";
    echo "<td>".$row['city']."</td>";
    echo "<td>".$row['contact_number']."</td>";
    echo "<td>".$row['email_id']."</td>"; 
    echo '<td>
<a data-toggle="modal" data-target="#display-owner" href="javascript:void(0);" 
    onclick="viewAction('.$row['owner_id'].');" title="View Owner" 
    class="display-owner ml-1 btn-ext-small btn btn-sm btn-info" data-ownerid="">
    <i class="fas fa-eye"></i>
</a>
    
<a data-toggle="modal" data-target="#update-owner" href="javascript:;" 
    onclick="editAction('.$row['owner_id'].');" title="Update Owner" 
    class="update-owner-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-ownerid="">
    <i class="fas fa-edit"></i>
</a>

<a data-toggle="modal" data-target="#delete-owner" href="javascript:void(0);" 
    onclick="deleteAction('.$row['owner_id'].');" title="Delete Owner" 
    class="delete-owner-details ml-1 btn-ext-small btn btn-sm btn-danger"  data-ownerid="">
    <i class="fas fa-times"></i>
</a>
</td>';
}
?> 
     </tr>
    </tbody>
   </table>
  </div>
 </div>
</div>
</div>
</div>
</div>
</div>
<div id="divShowChildWindowValues" style="display:none; border:1px dashed black;padding:10px;color:Green; width:300px; font-size:12pt;text-align:left"  >

</div>
</section>

   </div> 
<script>
    jQuery(document).ready(function () {
        jQuery('#manageOwner').dataTable({
            "lengthChange": false,
            "paging": true,
            "processing": false,
            "order": [],            
        });        
        function filterGlobal(v) {
            jQuery('#manageOwner').DataTable().search(
                    v,
                    false,
                    false
                    ).draw();
        }
        jQuery('input.global_filter').on('keyup click', function () {
            var v = jQuery(this).val();    
            filterGlobal(v);
        });
        jQuery('input.column_filter').on('keyup click', function () {
            jQuery('#manageOwner').DataTable().ajax.reload();
        });
    });
 </script>
<script>


var modalWin = new CreateModalPopUpObject();
 modalWin.SetLoadingImagePath("../images/loading.gif");
 modalWin.SetCloseButtonImagePath("../images/remove.gif");

function addAction()
{
    var url = 'owner.php';
    window.location = url;
    //popupWindow = window.open(url,'_blank',
     //       'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
}
function viewAction(id)
{

    var url = 'view.php?id='+encodeURIComponent(id);

    modalWin.ShowURL(url,600,800,'Property Details',null,null,true)

   // popupWindow = window.open(url,'_blank',
           // 'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
}
function editAction(id)
{

    var url = 'edit.php?id='+encodeURIComponent(id);
    window.location = url;
    //popupWindow = window.open(url,'_blank',
            //'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
}

function deleteAction(id)
{
    let text;
    if (confirm("Are you sure you want to delete this Owner?") == true) {
      var url = 'delete.php?id='+encodeURIComponent(id);
      window.location = url;
      //alert("Deleted Successfully !");
    }
}

function HideModalWindow() {
    modalWin.HideModalPopUp();
}


</script>  


<?php include '../footer.php';?> 