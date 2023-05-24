<?php  

session_start();  
include_once ('conn.php');
include_once ('path.php');

if(isset($_POST["login"]))  
{  
if(empty($_POST["Email"]) || empty($_POST["Password"]))  
 { 
 $message = '<label>All fields are required</label>';  
 }  
else  
 { 


$Email = $_POST["Email"];
$Password = $_POST["Password"];
$result = $dbConn->query("SELECT id, Email, UserName FROM users WHERE Email = '$Email' AND Password = '$Password' ");
$result->execute(); 
if($row = $result->fetch(PDO::FETCH_ASSOC))
{
   $_SESSION["Email"] = $row['Email']; 
   $_SESSION["id"] = $row['id']; 
   $_SESSION["UserName"] = $row['UserName']; 
   header("location: /".FOLDER_NAME."/dashboard/dashboard.php");  
}
else  
{  
    $message = '<label>Invalid Credentials</label>';  
}
          
}
}
?>  

     <!-----------Html-------------->

<!DOCTYPE html>  
<html>  
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asset Management | Log in</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="css/asset-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
                        z.defer = !0, z.src = "../../../../cdn-cgi/zaraz/sd0d9.html?z=" + btoa(
                            encodeURIComponent(JSON.stringify(a.zarazData))), t.parentNode.insertBefore(z,
                            t)
                    }))
            }(w, d, 0, "script");
        })(window, document);
    </script>
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <style>
    body {
  font-family: 'Poppins'!important;
}
.hide {
  display: none;
}
p {
  font-weight: normal;
}
    .fa-google {
  background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  -webkit-text-fill-color: transparent;
}
</style>
</head>

<body class="hold-transition login-page">
 <div class="login-box">
  <div class="login-logo">
    <div class="logo">
        <a href="../../index.html"><img src="../../images/logo.png" class="img-responsive" alt="" /></a>
     </div>
   <a href="index.php"><b>Asset Management</b></a>
  </div>
 <?php  
   if(isset($message))  
   {  
    echo '<label class="text-danger">'.$message.'</label>';  
   }  
  ?>    
 <div class="card">
  <div class="card-body login-card-body">
   <p class="login-box-msg">Sign in to start your session</p>
  <form action="" method="post">
   <input type="hidden" name="_token" value="SWtQmyeL9a8TouzNkabWAYtWJBgji67YkmpDEHgB">

        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Email/Username" name="Email">
        <div class="input-group-append">
         <div class="input-group-text">
          <span class="fa fa-envelope"></span>
          </div>
         </div>
        </div>

         <span class="text-danger"></span>
          <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" name="Password">
          <div class="input-group-append">
           <div class="input-group-text">
            <span class="fa fa-lock"></span>
           </div>
          </div>
         </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" name="login" class="btn btn-primary btn-block" value="Login" onclick="javascript:window.location='dashboard.php';">
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-solid">
          <i class="fab fa-google  mr-2"></i> Sign in using Gmail
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->

 </div>
  </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

  <script type="text/javascript">
                function checkEmail(){


    var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        
    if (!filter.test(emailid.value))
    { 
    
        alert('Please provide a valid email address'); 
        return false;
   }
       
    return true;
 }
            </script> 

 </body>  
</html>   