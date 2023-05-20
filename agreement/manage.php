<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 include '../menu.php';
 ?>
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
       <h3 class="card-title">Agreement</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Agreement</li>
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
        <div class="col-lg-6 col-md-6 col-xs-6" style="text-align:right"></div> 
       </div>
  <div class="row">
          <div class="col-lg-12"><span id="success-msg"></div>
  </div>

<div class="card-body">
    <div class="row">
            <div class="col-lg-12">
                <a href="javascript:" onclick="rentDetails();" title="Rent Details" data-toggle="modal" data-target="#add-lease" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-rupee"></i> Rent</a>  

                <a href="javascript:" onclick="docUpload();" title="Upload Agreement" data-toggle="modal" data-target="#add-lease" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-upload"></i> Agreement</a>  

                <a href="javascript:" onclick="addAction();" title="Add Agreement"  data-toggle="modal" data-target="#add-lease" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Add</a> 

          
            </div>
            
        </div>

 <div class="">
<table id="manageAgreement" class="table table-responsive table-bordered table-hover small display nowrap">
 <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Property Name</th>
    <th scope="col">Tenant Name</th>
    <th scope="col">Property Type</th>
    <!--<th scope="col">Property Location</th>-->
    <th scope="col">Agreement Date</th>    
    <th scope="col">Locking Period</th>
    <th scope="col">Days Left</th>
    <th scope="col">Rent Status</th>  
    <th scope="col">Action</th>
   <!-- <th scope="col">Upload</th>-->
   </tr>
  </thead>

<tbody>
<?php   
  $result = $dbConn->query("SELECT a.agreement_id, a.property_id, a.tenant_id,
(select concat(p.property_name,' - ',p.flat_no,', ', nvl(p.location,''), ',', nvl((select c.name from cities c where c.id = p.city_id),''), ' - ',p.pincode) from det_property p where p.property_id = a.property_id) as property_name,
(select p.location from det_property p where p.property_id = a.property_id) as property_location,
(select c.name from cities c where c.id = (select p.city_id from det_property p where p.property_id = a.property_id)) as city,
(select t.tenant_name from det_tenant t where t.tenant_id = a.tenant_id) as tenant_name,
(select mc.param_value from mst_common_param mc where mc.param_code = (select p.property_type from det_property p where p.property_id = a.property_id)) as property_type,
a.agreement_from, a.agreement_to, DATEDIFF(a.agreement_from, a.agreement_to) AS days, 
a.locking_period, a.status, '4' as rentCount, '5' as agreeCount
FROM det_agreement a where status ='Active' ORDER BY agreement_id desc;
");
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {    
    if($row["days"]<=0){
        $dayColor = "tagred";
        $validity = "Expired";
    }else if($row["days"]>0 & $row["days"]<=30){
        $dayColor = "tagyellow";
        $validity = "";
    }else if($row["days"]>30 & $row["days"]<=90){
        $dayColor = "tagblue";
        $validity = "";
    }else{
        $dayColor = "taggreen";
        $validity = "";
    }
?>
<tr>
   
   <?php
        echo "<td><input type='radio' name='property' id=".$row['agreement_id']." value=".$row['agreement_id']." ' onclick='showCount()'/></td>";
        echo "<td>".$row['property_name']."</td>";
        echo "<td>".$row['tenant_name']."</td>";
        echo "<td>".$row['property_type']."</td>";
        //echo "<td>".$row['property_location'].", ".$row['city']."</td>";
        echo "<td>".$row['agreement_from']."</td>"; 
        echo "<td>".$row['locking_period']." Month</td>"; 
        echo "<td align='right'><span class='".$dayColor."'>".$row['days']."</span></td>"; 
        echo "<td>".$row['status']."</td>"; 
        echo '<td>
    <a data-toggle="modal" data-target="#display-property" href="javascript:void(0);" 
        onclick="viewAction('.$row['agreement_id'].');" title="View Property" 
        class="display-property ml-1 btn-ext-small btn btn-sm btn-info" data-propertyid="">
        <i class="fas fa-eye"></i>
    </a>
        
    <a data-toggle="modal" data-target="#update-property" href="javascript:;" 
        onclick="editAction('.$row['agreement_id'].');" title="Update Property" 
        class="update-property-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-propertyid="">
        <i class="fas fa-edit"></i>
    </a>

    <a data-toggle="modal" data-target="#delete-property" href="javascript:void(0);" 
        onclick="deleteAction('.$row['agreement_id'].');" title="Delete Property" 
        class="delete-property-details ml-1 btn-ext-small btn btn-sm btn-danger"  data-propertyid="">
        <i class="fas fa-times"></i>
    </a>
    </td>';
   // echo "<td><div class='file_upload'>
     //   <form action='file_upload.php' class='dropzone'>
       //     <div class='dz-message needsclick'>
         //       <strong><i class='fa fa-upload'></i></strong>
           // </div>
        //</form>     
    //</div></td>";     
    }
    ?> 
     </tr>
    </tbody>
   </table>
  </div>

 </div><!--card body-->

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

function showCount()
{
    
    let id = $('input[name="property"]:checked').val();
    let myJavascriptVar = "3";
    if(id != null || id =='')
    {
        // alert("Inside if");
        //document.cookie = "myJavascriptVar = " + myJavascriptVar
        document.cookie = "rentCount = "+myJavascriptVar;
    }
    else
    {
        alert("Please select one of the agreement!");
    }
}

function docUpload()
{
    
    let id = $('input[name="property"]:checked').val();
    if(id != null || id =='')
    {
        var url = 'doc-details.php?id='+encodeURIComponent(id);
        window.location = url;
        //window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=800,height=600,directories=no,location=no');
    }
    else
    {
        alert("Please select one of the agreement!");
    }
}

function rentDetails()
{
    
    let id = $('input[name="property"]:checked').val();
    if(id != null || id =='')
    {
        var url = '../rent/manage.php?id='+encodeURIComponent(id);
        window.location = url;
       // window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=800,height=600,directories=no,location=no');
    }
    else
    {
        alert("Please select one of the agreement!");
    }
}

    jQuery(document).ready(function () {
        jQuery('#manageAgreement').dataTable({
            "lengthChange": false,
            "paging": true,
            "processing": false,
            "order": [],
            "scrollX": false,        
        });        
        function filterGlobal(v) {
            jQuery('#manageAgreement').DataTable().search(
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
            jQuery('#manageAgreement').DataTable().ajax.reload();
        });
    });
 </script>
 
<script>
var modalWin = new CreateModalPopUpObject();
 modalWin.SetLoadingImagePath("../images/loading.gif");
 modalWin.SetCloseButtonImagePath("../images/remove.gif");
function addAction()
{
    var url = 'agreement.php';
    window.location = url;
    //popupWindow = window.open(url,'_blank',
      //      'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
}
function viewAction(id)
{

    var url = 'view.php?id='+encodeURIComponent(id);
    modalWin.ShowURL(url,700,1000,'Property Details',null,null,true)
    //popupWindow = window.open(url,'_blank',
      //      'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
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

function HideModalWindow() {
    modalWin.HideModalPopUp();
}



</script>  


<?php include '../footer.php';?> 