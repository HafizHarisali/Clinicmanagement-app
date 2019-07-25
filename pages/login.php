<?php
 ob_start();
 session_start();
 session_destroy();
 session_cache_expire();
 session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login | Dental Clinic</title>

  <!-- Custom fonts for this template-->
  <link href="../../Clinicmanagement/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../Clinicmanagement/admin/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../Clinicmanagement/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../Clinicmanagement/admin/css/login.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>
  <style type="text/css">
   


  </style>
</head>

<body style="background-color: #185479">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9 mt-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                  	<img src="../../Clinicmanagement/images/logo.png" width="180" height="150">
                    
                  </div>

                  <?php
                    include('../../Clinicmanagement/controllers/accountscontroller.php');
                    if(isset($_POST["btnlogin"]))
      	      			{
      	      			$login=new accounts;
      	      			$login->login($_POST["email"],$_POST["password"]);
      			        
      		          }
                  ?>
                  <form method="post" class="ml-4">
 
                  
                  <input placeholder="Email address" type="email" name="email" onblur="this.setAttribute('value', this.value);" value="" required>
                  <span class="validation-text">Please enter a valid email address.</span>
                  <input placeholder="Password" type="password" name="password" value="" required>
                 
                  <button type="submit" name="btnlogin">Login</button>
                </form>
                  
                 <!--  <div class="text-center mt-3">
                    <a class="small" href="../../Clinicmanagement/admin/forgot-password.html">Forgot Password?</a>
                  </div> -->
                  <!--<div class="text-center">
                    <a class="small" href="../../Clinicmanagement/admin/register.html">Create an Account!</a>
                  </div>-->
                </div>
              </div>
              <div class="col-lg-2"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../Clinicmanagement/admin/vendor/jquery/jquery.min.js"></script>
  <script src="../../Clinicmanagement/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../Clinicmanagement/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../Clinicmanagement/admin/js/sb-admin-2.min.js"></script>

</body>

</html>
