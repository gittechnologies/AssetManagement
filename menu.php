<?php include_once('path.php') ?>
<!DOCTYPE html>
 <html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Asset Management</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">







<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />-->

<link rel="stylesheet" href="<?php echo URL ?>css/jqvmap.min.css">

<link rel="stylesheet" href="<?php echo URL ?>css/asset-style.css">



<link rel="stylesheet" href="<?php echo URL ?>css/OverlayScrollbars.min.css">
<!--
<link rel="stylesheet" href="<?php echo URL ?>css/daterangepicker.css">

<link rel="stylesheet" href="<?php echo URL ?>css/icheck-bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo URL ?>css/tempusdominus-bootstrap-4.min.css">
<link href="<?php echo URL ?>css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo URL ?>css/dropzone.css">

<link rel="stylesheet" href="<?php echo URL ?>css/summernote-bs4.min.css">-->

  


<!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
<script>
  (function(w, d) {
   ! function(a, e, t, r, z) {
    a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = {
                    deferred: []
  };
    var s = e.getElementsByTagName("title")[0];
    s && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a
    .zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a
    .zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a
    .zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.dataLayer = a
    .dataLayer || [], a.zaraz.track = (e, t) => {
for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key]
   }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => {
    a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r])
    }, a.dataLayer.push({
    "zaraz.start": (new Date).getTime()
    }), a.addEventListener("DOMContentLoaded", (() => {
    var t = e.getElementsByTagName(r)[0],
    z = e.createElement(r);
    z.defer = !0, z.src = "..cdn-cgi/zaraz/sd0d9.html?z=" + btoa(encodeURIComponent(JSON
    .stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
}))
    }(w, d, 0, "script");
 })(window, document);



</script>

<link rel="stylesheet" href="<?php echo URL ?>css/style.css">
<link rel="stylesheet" href="<?php echo URL ?>css/responsive.css">
<link rel="stylesheet" href="<?php echo URL ?>css/font-awesome.css">
<link rel="stylesheet" href="<?php echo URL ?>css/font-awesome.min.css">

<style>


div li.abc2 {
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:25px;
  height:25px;
  border-radius:50%;
  background-color:#000;
  color:#fff;
}

body {
  font-family: 'Poppins';
}
.hide {
  display: none;
}
p {
  font-weight: normal;
}

</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
 <ul class="navbar-nav">
  <li class="nav-item">
   <a class="nav-link" data-widget="pushmenu" href="#" role="button">
    <i class="fa fa-bars"></i></a>
  </li>
 </ul>

<ul class="navbar-nav ml-auto">
 <li class="nav-item">
  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
   <i class="fa fa-arrows-alt" aria-hidden="true"></i>
  </a>
 </li>

<li class="nav-item dropdown">
 <a class="nav-link" data-toggle="dropdown" href="#">
  <h5>
<?php
if(isset($_SESSION["Email"]))
{
echo ' '.$_SESSION["UserName"].'';
}

?>
   <i class="right fa fa-angle-down"></i></h5>
 </a>

<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
 <div class="dropdown-divider"></div>
  <a href="/<?php echo FOLDER_NAME ?>/reset-password.php" class="dropdown-item">
   <i class="fa fa-lock  mr-2"></i>Reset Password
  </a>

<div class="dropdown-divider"></div>
 <a href="/<?php echo FOLDER_NAME ?>/logout.php" class="dropdown-item">
  <i class="fa fa-share-square mr-2"></i> Logout
 </a>
    </li>
   </ul>
  </nav> 
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="/dashboard" class="brand-link">
<img src="<?php echo URL ?>images/git-logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
<span class="brand-text font-weight-bold text-light">Asset Management</span>
</a>

<div class="sidebar">
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!----------Dashboard------------->

  <li class="nav-item menu-open">
   <a href="/<?php echo FOLDER_NAME ?>/dashboard/dashboard.php" class="nav-link">
    <i class="fa fa-tachometer" aria-hidden="true"></i>
     <p> Dashboard </p>
   </a>
</li>
         <!----------Property Management------------->       
<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
 <i class="nav-icon fas fa-building" aria-hidden="true"></i>
   <p>Property<i class="fa fa-angle-left right"></i></p>
 </a>

<ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/property/property.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Add Propert</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/property/manage.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Property Details</p>
 </a>
</li>
</ul>
</li>

         <!----------Property Management------------->       
<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
 <i class="nav-icon fa fa-user-secret" aria-hidden="true"></i>
   <p>Owner<i class="fa fa-angle-left right"></i></p>
 </a>

<ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/owner/owner.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Add Owner</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/owner/manage.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Owner Details</p>
 </a>
</li>
</ul>
</li>
               <!----------Tenant Management------------->
<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
 <i class="nav-icon fa fa-user-o" aria-hidden="true"></i>
   <p>Tenant<i class="fa fa-angle-left right"></i></p>
 </a>
 <ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/tenant/tenant.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Add Tenant</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/tenant/manage.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Tenant Details</p>
 </a>
</li>
</ul>
</li>

<!----------Manager Management------------->

<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
<i class="nav-icon fa fa-user-circle-o"> </i>  
 <p>Commission Agent<i class="fa fa-angle-left right"></i>
   </p>
 </a>
 <ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/manager/manager.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Add Commission Agent</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/manager/manage.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Commission Agent Details</p>
 </a>
</li>
</ul>
</li>

                <!----------Agreement Management------------->
<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
  <i class="nav-icon fas fa-file-contract"></i>
   <p>Agreement<i class="fa fa-angle-left right"></i></p>
 </a>
 <ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/agreement/agreement.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Add Agreement</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/agreement/manage.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Agreement Details</p>
 </a>
</li>
</ul>
</li>
        
        <!----------Rent Management------------->
<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
  <i class="nav-icon fa fa-rupee"></i>
   <p>Rental Payment<i class="fa fa-angle-left right"></i></p>
 </a>
 <ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/rent/rent.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Rent Payment</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/rent/manage.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Payment Details</p>
 </a>
</li>
</ul>
</li>      

<!----------Reports------------->

<li class="nav-item menu-is-opening">
 <a href="#" class="nav-link active ">
<i class="nav-icon fa fa-clipboard"></i> 
 <p>Reports
    <i class="fa fa-angle-left right"></i>
   </p>
 </a>

<ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="/<?php echo FOLDER_NAME ?>/reports/propertyReports.php" class="nav-link nav-tree active">
   <i class="fa fa-circle-o" aria-hidden="true"></i>
    <p>Property Report</p>
   </a>
 </li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/reports/tenantReports.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Tenant Report</p>
 </a>
</li>

<li class="nav-item">
 <a href="/<?php echo FOLDER_NAME ?>/reports/agreementReports.php" class="nav-link nav-tree">
  <i class="fa fa-circle-o" aria-hidden="true"></i>
   <p>Agreement Report</p>
 </a>
</li>
</ul>

</li>
</ul>
</nav>

</div>
</aside>