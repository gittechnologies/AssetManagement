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
       <h3 class="card-title">Rent</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Paid Invoice</li>
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


 <div class="">
<table id="manageAgreement" class="table table-bordered table-hover small display nowrap">
 <thead>
  <tr>
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

    $result = $dbConn->query("SELECT r.rent_id, r.agreement_id, r.invoice_no, r.creation_date as invoice_date,
  (select t.tenant_name from det_tenant t where t.tenant_id = 
  (select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_name,
  (select concat(p.property_name,' - ',p.flat_no,', ', nvl(p.location,''), ',', nvl((select c.name from cities c where c.id = p.city_id),'')) 
  from det_property p where p.property_id = 
  (select a.property_id from det_agreement a where a.agreement_id = r.agreement_id)) as property_name,
   DATE_FORMAT(r.rent_date, '%b-%Y') AS period, r.total_amount
   FROM det_rent r where r.rent_status = 'PAID' ORDER BY r.rent_id DESC");

    $result->execute();

    if($result->rowCount() > 0){ 
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {    

  ?>
<tr>
   
   <?php
        echo "<td>".$row['invoice_no']."</td>";
        echo "<td>".$row['invoice_date']."</td>";
        echo "<td>".$row['tenant_name']."</td>";
        echo "<td>".$row['property_name']."</td>"; 
        echo "<td>".$row['period']."</td>";      
        echo "<td>".$row['total_amount']."</td>"; 
        echo '<td>
    <a data-toggle="modal" data-target="#display-property" href="javascript:void(0);" 
        onclick="viewAction('.$row['rent_id'].');" title="View Property" 
        class="display-property ml-1 btn-ext-small btn btn-xs btn-info" data-propertyid="">
        <i class="fas fa-eye"></i>
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

function viewAction(id)
{

    var url = 'view.php?id='+encodeURIComponent(id);
    modalWin.ShowURL(url,700,1000,'Property Details',null,null,true)
    //popupWindow = window.open(url,'_blank',
      //      'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
}

function HideModalWindow() {
    modalWin.HideModalPopUp();
}
</script>  
  
   <?php include '../footer.php';?> 


