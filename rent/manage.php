<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 include '../menu.php';

if (isset($_GET['id'])) {
    $agreement_id = $_GET['id'];
}

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
       <h3 class="card-title">Rent</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Rent</li>
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
                <a href="javascript:" onclick="rentDetails();" title="Rent Payment" data-toggle="modal" data-target="#payment-rent" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-rupee"></i> Payment</a>  

                <a href="javascript:" onclick="rentInvoice();" title="Generate Invoice" data-toggle="modal" data-target="#invocie-rent" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-rupee"></i> Invoice</a>  

                <a href="javascript:" onclick="addAction();" title="Add Agreement"  data-toggle="modal" data-target="#add-lease" class="float-right btn btn-primary btn-sm" style="margin:-15px 4px 4px 4px;"><i class="fa fa-plus"></i> Add</a> 

          
            </div>
            
        </div>

 <div class="">
<table id="manageAgreement" class="table table-bordered table-hover small display nowrap">
 <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Invoice No.</th>
    <th scope="col">Invoice Date</th>
    <th scope="col">Tenant Name</th>
    <th scope="col">Property Name</th>
    
    <!--<th scope="col">Property Location</th>-->
    <th scope="col">Period</th>    
    <th scope="col">Rent Amount</th>
    <th scope="col">Action</th>
   </tr>
  </thead>

<tbody>
  <?php   
    $subQuery = '';

    if (isset($agreement_id)) {
        $subQuery = " where r.agreement_id='".$agreement_id."'"; 
    }

    $result = $dbConn->query("SELECT r.rent_id, r.agreement_id, r.invoice_no, r.creation_date as invoice_date,
  (select t.tenant_name from det_tenant t where t.tenant_id = 
  (select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_name,
  (select concat(p.property_name,' - ',p.flat_no,', ', nvl(p.location,''), ',', nvl((select c.name from cities c where c.id = p.city_id),'')) 
  from det_property p where p.property_id = 
  (select a.property_id from det_agreement a where a.agreement_id = r.agreement_id)) as property_name,
   DATE_FORMAT(r.rent_date, '%b-%Y') AS period, r.total_amount
   FROM det_rent r".$subQuery);

    $result->execute();

    if($result->rowCount() > 0){ 
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {    

  ?>
<tr>
   
   <?php
        echo "<td><input type='radio' name='rent' id=".$row['rent_id']." 
        value=".$row['rent_id']." '/></td>";
        echo "<td>".$row['invoice_no']."</td>";
        echo "<td>".$row['invoice_date']."</td>";
        echo "<td>".$row['tenant_name']."</td>";
        echo "<td>".$row['property_name']."</td>"; 
        echo "<td>".$row['period']."</td>";      
        echo "<td>".$row['total_amount']."</td>"; 
        echo '<td>
    <a data-toggle="modal" data-target="#display-property" href="javascript:void(0);" 
        onclick="viewAction('.$row['rent_id'].');" title="View Property" 
        class="display-property ml-1 btn-ext-small btn btn-sm btn-info" data-propertyid="">
        <i class="fas fa-eye"></i>
    </a>
        
    <a data-toggle="modal" data-target="#update-property" href="javascript:;" 
        onclick="editAction('.$row['rent_id'].');" title="Update Property" 
        class="update-property-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-propertyid="">
        <i class="fas fa-edit"></i>
    </a>

    <a data-toggle="modal" data-target="#delete-property" href="javascript:void(0);" 
        onclick="deleteAction('.$row['rent_id'].');" title="Delete Property" 
        class="delete-property-details ml-1 btn-ext-small btn btn-sm btn-danger"  data-propertyid="">
        <i class="fas fa-times"></i>
    </a>
    </td>';    
	  }
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
    
    let id = $('input[name="rent"]:checked').val();
    if(id != null || id =='')
    {
        var url = 'rent-details.php?id='+encodeURIComponent(id);
        window.location = url;
       // window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=800,height=600,directories=no,location=no');
    }
    else
    {
        alert("Please select one of the tenant!");
    }
}

function rentInvoice()
{
    
    let id = $('input[name="rent"]:checked').val();
    if(id != null || id =='')
    {
        var url = 'invoice.php?id='+encodeURIComponent(id);
        window.location = url;
       //window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1000,height=800,directories=no,location=no');
    }
    else
    {
        alert("Please select one of the invoice!");
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
    var url = 'rent.php';
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


