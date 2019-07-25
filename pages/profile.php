<?php ob_start();
session_start();
?>
 <?php include('../../Clinicmanagement/layouts/navbar.php')?>
    <!-- End of Sidebar -->
 <style type="text/css">
                .form-control {
                        border-radius: 0px;
                        background-color: transparent;
                        border-color: #185479;
                    }
                    
                    .btn {
                        color: white;
                        background-color: #185479;
                        border-radius: 0px;
                    }

                      #treatmentform label.error {
                        width:auto;
                        display:block;
                        color:red;
                        margin:10px 0px 5px 0px;
                        font-style:italic;
                        font-size:smaller;
                      }

                      .error {
                         font-size: 1rem; 
                        position: relative;
                        line-height: 1;
                         width:437px;
                    }
                
                </style>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       <?php include('../../Clinicmanagement/layouts/topbar.php')?>
        <!-- End of Topbar -->
        <?php 
        $db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
        $sel=$db->query("SELECT * FROM users Where Id=".$_SESSION["Id"]);
        $row=$sel->fetch();
        ?>
        <div class="row">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
        		<div class="card shadow h-100 py-2">
                <div class="card-body">
                	  <form method="post" id="editprofileform">
                      <input type="hidden" name="id" value="<?php echo $row['Id']?>">
                     <label class="mt-3">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['Name']?>">

                     <label class="mt-3">Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $row['Address']?>">

                    <label class="mt-3">Contact</label>
                    <input type="text" name="contactno" class="form-control" value="<?php echo $row['Contactno']?>">

                     <label class="mt-3">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $row['Email']?>">

                     <label class="mt-3">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $row['Password']?>">

                    <input type="submit" name="btnupdate" class="btn mt-3 btn-block" value="Update"> 
                 </form>
                </div>
              </div>
        	</div>
        	<div class="col-md-3"></div>
        </div>

      </div>
      <?php
      if(isset($_POST["btnupdate"]))
      {
        require('../../Clinicmanagement/controllers/accountscontroller.php');
        $update=new accounts;
        $update->updateprofile($_POST["id"],$_POST["name"],$_POST["address"],$_POST["contactno"],$_POST["email"],$_POST["password"]);
        header('location:profile.php');
        
      }
      ?>

      <!-- Footer -->
    <?php include('../../Clinicmanagement/layouts/footer.php') ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 <script>
$(document).ready(function () {

$('#editprofileform').validate({ 
rules: {
  name: {
      required: true,
      lettersOnly:true,
      minlength:3
  },
  contactno: {
      required: true,
      minlength: 11,
      numbersOnly:true
  },

  address:{
    required:true,
  },

  email:{
    required:true,
    email:true
  },

  password:{
    required:true,
  },


}
});
});
</script>