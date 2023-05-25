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
       <h3 class="card-title">Tenant</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Tenant</li>
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
                <a href="javascript:" onclick="addDirectors();" title="Add Directors" data-toggle="modal" data-target="#directors" id="directors-btn" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Add Directors</a>
                <a href="javascript:" onclick="addAction();" data-toggle="modal" data-target="#add-tenant" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Add Tenant</a>              
            </div>
        </div>
 <div class="">
<table id="manageTenant" class="table table-bordered table-hover small">
 <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Tenant Type</th>
    <th scope="col">Tenant Name</th>
    <th scope="col">City</th>
    <th scope="col">Contact Number</th> 
    <th scope="col">Email</th> 
    <th scope="col">Action</th>
   </tr>
  </thead>
<tbody>
<?php   
  $result = $dbConn->query("SELECT t.tenant_id, t.tenant_name, t.tenantType,
(select c.name from cities c where c.id = t.city_id) as city, t.contact_number, t.email_id 
FROM det_tenant t where status = 'Active'");
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {   
    $tenantType = '';
    if ($row['tenantType']=='I') {
        $tenantType = 'Individual';
    }   elseif ($row['tenantType']=='NI')
    {
        $tenantType = 'Non Individual'; 
    }
?>
<tr class="tenant-row">
    
 
<?php
    echo "<td><input type='radio' name='tenant_id' id=".$row['tenant_id']." value=".$row['tenant_id']." '/></td>";
    echo "<td class='tenant-type'>".$tenantType."</td>";
    echo "<td>".$row['tenant_name']."</td>";
    echo "<td>".$row['city']."</td>";
    echo "<td>".$row['contact_number']."</td>";
    echo "<td>".$row['email_id']."</td>"; 
    echo '<td>
<a data-toggle="modal" data-target="#display-tenant" href="javascript:void(0);" 
    onclick="viewAction('.$row['tenant_id'].');" title="View Tenant" 
    class="display-tenant ml-1 btn-ext-small btn btn-sm btn-info" data-tenantid="">
    <i class="fas fa-eye"></i>
</a>
    
<a data-toggle="modal" data-target="#update-tenant" href="javascript:;" 
    onclick="editAction('.$row['tenant_id'].');" title="Update Tenant" 
    class="update-tenant-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-tenantid="">
    <i class="fas fa-edit"></i>
</a>

<a data-toggle="modal" data-target="#delete-tenant" href="javascript:void(0);" 
    onclick="deleteAction('.$row['tenant_id'].');" title="Delete Tenant" 
    class="delete-tenant-details ml-1 btn-ext-small btn btn-sm btn-danger"  data-tenantid="">
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
        jQuery('#manageTenant').dataTable({
            "lengthChange": false,
            "paging": true,
            "processing": false,
            "order": [],            
        });        
        function filterGlobal(v) {
            jQuery('#manageTenant').DataTable().search(
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
            jQuery('#manageTenant').DataTable().ajax.reload();
        });
    });
 </script>
<script>


var modalWin = new CreateModalPopUpObject();
 modalWin.SetLoadingImagePath("../images/loading.gif");
 modalWin.SetCloseButtonImagePath("../images/remove.gif");

function addAction()
{
    var url = 'tenant.php';
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
    if (confirm("Are you sure you want to delete this Tenant?") == true) {
      var url = 'delete.php?id='+encodeURIComponent(id);
      window.location = url;
      //alert("Deleted Successfully !");
    }
}

function HideModalWindow() {
    modalWin.HideModalPopUp();
}

function addDirectors()
{
    
    let id = $('input[name="tenant_id"]:checked').val();
    if(id != null || id =='')
    {   
        let tenant_type = $('#tenant-active .tenant-type').text();
        console.log(tenant_type);

        if (tenant_type == 'Non Individual')  {
            var url = 'director-details.php?id='+encodeURIComponent(id);
            window.location = url;
        }   else {
            alert("This applicable only for Non Individual tenant type");
        }
    }
    else
    {
        alert("Please select one of the tenant!");
    }
}

$(document).on('change','input[name="tenant_id"]',function (){
    $('#manageTenant .tenant-row').removeAttr('id');
    $("#directors-btn").removeClass("disabled");

    $(this).closest('tr').attr('id', 'tenant-active');
    let tenant_type = $('#tenant-active .tenant-type').text();

    if (tenant_type != 'Non Individual')  {
        $("#directors-btn").addClass("disabled");
    }   
});

</script>  


<?php include '../footer.php';?> 