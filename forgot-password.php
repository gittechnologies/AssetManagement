<?php

 session_start();
 include_once ('conn.php');
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Asset Management | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="css/asset-style.css">
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
  font-weight:normal !important;
}
.hide {
  display: none;
}
p {
  font-weight: normal;
}

</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
     <div class="logo">
        <a href="../../index.html"><img src="../../images/logo.png" class="img-responsive" alt="" /></a>
     </div>
    <a href="index.php"><b>Asset </b>Management</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="recover-password.html" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary" onclick="sendMail.php">Request new password</button>

          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>