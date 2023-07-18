<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: login.php");
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
       <h3 class="card-title">Property</h3>
	     <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">Property</li>
         </ol>
      </div>
	 </div>
	</div>
   </div>
  </div>  
  <div class="container-fluid1">
   <div class="row">
    <div class="col-md-12">
     <div class="card">
      <div class="flash-message">
       <div class="row">  
        <div class="col-lg-6 col-md-6 col-xs-6" style="text-align:right"></div> 
       </div>
      <div class="row">
              <div class="col-lg-12"><span id="success-msg"></div>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <a href="javascript:" onclick="addOwner();" title="Unit Details" data-toggle="modal" data-target="#owner" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Unit Details</a>
                
                <a href="javascript:" onclick="addAction();" data-toggle="modal" data-target="#add-property" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Add Property</a>              
            </div>
        </div>
 <div class="">
<table id="manageProperty" class="table table-bordered table-hover small">
 <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Property Type</th>
    <th scope="col">Property Name</th>    
    <th scope="col">Location</th>
    <th scope="col">City</th> 
    <!-- <th scope="col">Owner Name</th> -->
    <th scope="col">Action</th> 
   </tr>
  </thead>

<tbody>
<?php   
  $result = $dbConn->query("SELECT p.property_id, p.property_name, 
(select mc.param_value from mst_common_param mc where mc.param_code = p.property_type) as property_type,
p.location, 
(select c.name from cities c where c.id = p.city_id) as city,
(select o.owner_name from det_owner o where o.owner_id = p.owner_id) as owner_name 
FROM det_property p where status = 'Active' order by p.property_id  desc");
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {    
?>
<tr>
    <?php
        echo "<td><input type='radio' name='property_id' id=".$row['property_id']." 
        value=".$row['property_id']." '/></td>";
        echo "<td>".$row['property_type']."</td>";
        echo "<td>".$row['property_name']."</td>";
        echo "<td>".$row['location']."</td>";
        echo "<td>".$row['city']."</td>"; 
        // echo "<td>".$row['owner_name']."</td>"; 
        echo '<td>
    <a data-toggle="modal" data-target="#display-property" href="javascript:void(0);" 
        onclick="viewAction('.$row['property_id'].');" title="View Property" 
        class="display-property ml-1 btn-ext-small btn btn-xs btn-info" data-propertyid="">
        <i class="fas fa-eye"></i>
    </a>
        
    <a data-toggle="modal" data-target="#update-property" href="javascript:;" 
        onclick="editAction('.$row['property_id'].');" title="Update Property" 
        class="update-property-details ml-1 btn-ext-small btn btn-xs btn-primary"  data-propertyid="">
        <i class="fas fa-edit"></i>
    </a>

    <a data-toggle="modal" data-target="#delete-property" href="javascript:void(0);" 
        onclick="deleteAction('.$row['property_id'].');" title="Delete Property" 
        class="delete-property-details ml-1 btn-ext-small btn btn-xs btn-danger"  data-propertyid="">
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
</section>
    <div id="divShowChildWindowValues" style="display:none; border:1px dashed black;padding:10px;color:Green; width:300px; font-size:12pt;text-align:left"  >

    </div>
</div> 
 <script>
    jQuery(document).ready(function () {
        jQuery('#manageProperty').dataTable({
            "lengthChange": false,
            "paging": true,
            "processing": false,
            "order": [],            
        });        
        function filterGlobal(v) {
            jQuery('#manageProperty').DataTable().search(
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
            jQuery('#manageProperty').DataTable().ajax.reload();
        });
    });
 </script>   
<script>
var modalWin = new CreateModalPopUpObject();
 modalWin.SetLoadingImagePath("../images/loading.gif");
 modalWin.SetCloseButtonImagePath("../images/remove.gif");
function addAction()
{
    var url = 'property.php';
    window.location = url;
    //popupWindow = window.open(url,'_blank',
            //'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
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
      //      'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
}

function deleteAction(id)
{
    let text;
    if (confirm("Are you sure you want to delete this property?") == true) {
      var url = 'delete.php?id='+encodeURIComponent(id);
      window.location = url;
      //alert("Deleted Successfully !");
    }
}

function addOwner()
{
    
    let id = $('input[name="property_id"]:checked').val();
    if(id != null || id =='')
    {
        var url = 'add-owner.php?id='+encodeURIComponent(id);
        window.location = url;
    }
    else
    {
        alert("Please select one of the property!");
    }
}


</script>  


<?php include '../footer.php';?> 