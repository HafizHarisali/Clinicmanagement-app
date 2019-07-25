<?php ob_start();?>
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

            #patientform label.error {
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

<!-- Begin Page Content -->
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800"></h1>
<a href="#" class="btn btn-sm shadow-sm btnaddpatient ripple-effect" style="background-color: #185479;color: white;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Patient</a>
<a href="#" class="btn btn-sm shadow-sm btnshowpatient ripple-effect" style="background-color: #185479;color: white;display: none;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Show Patient</a>
</div>
<div class="row">
<div class="col-xl-2 col-md-2"></div>
<div class="col-xl-8 col-md-8 addpatient" style="display: none;">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold cardheading">Add Patients</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form method="post" id="patientform">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label>Name</label>
                        <input type="text" name="name" id="pname" class="form-control">

                        <label class="mt-3">Address</label>
                        <input type="text" name="address" id="paddress" class="form-control">

                        <label class="mt-3">Contact</label>
                        <input type="number" name="contactno" id="pcontactno" class="form-control">

                        <label class="mt-3">Email</label>
                        <input type="email" name="email" id="pemail" class="form-control">

                        <label class="mt-3">Password</label>
                        <input type="text" name="password" id="ppassword" class="form-control">

                        <?php 
require('../../Clinicmanagement/controllers/patientscontroller.php');
$usertypes=new patients;
$select=$usertypes->getusertypes();
?>
                            <label class="mt-3">Type</label>
                            <select name="usertype" id="pusertype" class="form-control">
                                <?php while($row=$select->fetch()) {?>
                                    <option value="<?php echo $row['Id']?>">
                                        <?php echo $row["Usertype"]?>
                                    </option>
                                    <?php } ?>
                            </select>
                            <button class="btn mt-3 btn-block" name="btnsubmitpatient" id="btnsubmit" type="submit">Add Patient</button>
                    </div>

                </div>
            </form>
            <?php 
// $query=$db->query("Select * from users where Email=".$_POST["email"]);
// while($row=$query->fetch())
// {

// }
if(isset($_POST["btnsubmitpatient"]))
{
    $db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
    $checkquery=$db->query("SELECT Email from users where Usertypeid=2");
        $fetch=$checkquery->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fetch as $key) { 
            $check = $key["Email"];
            if($check==$_POST["email"])
            {
                $error = "Email Already exist";
            }

             else{
                $success="success";
            }
        }

        if(!empty($error))
        {
            echo "<script>swal('Email Already Exist!','warning');</script>";
        }
      
        else{
             $usertypes->addpatient($_POST["name"],$_POST["address"],$_POST["contactno"],$_POST["email"],$_POST["password"],$_POST["usertype"]);
            echo "<script>swal('Added Successfully!','success');</script>";
        }
}
?>

        </div>
    </div>
</div>
<div class="col-xl-2"></div>
</div>

<div class="card shadow mb-4 showpatient">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold" style="color: #185479;">Patients</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead style="background-color: #185479;color: white;">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
$select1=$usertypes->getpatients();
$i = 1;while($row=$select1->fetch()) { ?>
                    <tr>
                        <td>
                            <?php echo $row["Name"];?>
                        </td>
                        <td>
                            <?php echo $row["Address"];?>
                        </td>
                        <td>
                            <?php echo $row["Contactno"];?>
                        </td>
                        <td>
                            <?php echo $row["Email"];?>
                        </td>
                        <td>
                            <?php echo $row["Password"];?>
                        </td>
                        <td>
                            <?php echo $row["Usertype"];?>
                        </td>
                        <td class="dropdown no-arrow">
                            <a class="dropdown-toggle ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h fa-sm fa-fw" style="font-size: 18px;color:#185479;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <a href="#logoutModal" class="dropdown-item edit_btn" data-toggle="modal" data-backdrop="false" data-name="<?php echo $row['Name'];?>" data-address="<?php echo $row['Address'];?>" data-contactno="<?php echo $row['Contactno'];?>" data-email="<?php echo $row['Email']; ?>" data-password="<?php echo $row['Password'];?>" data-usertype="<?php echo $row['Usertype'];?>" data-id="<?php echo $row['Id'];?>">
Edit</a>
                                <a class="dropdown-item" href="<?php echo 'patients.php?action=delete&id='.$row['Id'] ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->

<?php
if(isset($_GET['action']))
{
if($_GET['action']=='delete')
{
$id=$_GET['id'];
$usertypes->deletepatients();
header('location:patients.php');

}
}
?>

</div>
<!-- End of Main Content -->

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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Patient</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xl-12 col-md-12">
    <form method="post" id="patienteditform">
        <div class="form-row">
            <input type="hidden" name="id" class="pid" />
            <label><span>Full Name</span></label>
            <input type="text" name="name" class="pname form-control" />
        </div>
        <div class="form-row">
            <label><span>Address</span></label>
            <input type="text" name="address" placeholder=" " class="paddress form-control" />
        </div>
        <div class="form-row">
            <label><span>Contact Number</span></label>
            <input type="number" name="contactno" placeholder=" " class="pcontactno form-control" />
        </div>
        <div class="form-row">
            <label><span>Email</span></label>
            <input type="email" name="email" placeholder=" " required="" class="pemail form-control" />
        </div>
        <div class="form-row">
            <label><span>Password</span></label>
            <input type="password" name="password" placeholder=" " required="" class="ppassword form-control" />
        </div>
        <div class="form-row mb-1">
            <label><span>User Type</span></label>
            <?php 
$select=$usertypes->getusertypes();
?>
                <select style="width: 683%;" name="usertype" class="pusertype form-control">
                    <?php while($row=$select->fetch()) {?>
                        <option value="<?php echo $row['Id']?>">
                            <?php echo $row["Usertype"]?>
                        </option>
                        <?php } ?>
                </select>
        </div>
        <div class="modal-footer mt-4">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="btnedit">Save Changes</button>
        </div>
    </form>
</div>

</div>
</div>

</div>
</div>
</div>

<?php
if(isset($_POST['btnedit']))
{
$usertypes->updatepatients($_POST['id'],$_POST['name'],$_POST['address'],$_POST['email'],$_POST['password'],
$_POST['contactno'],$_POST['usertype']);
header('location:patients.php');
}

?>

<script>
$(document).on("click", '.edit_btn', function(e) {
var name = $(this).data('name');
var id = $(this).data('id');
var address = $(this).data('address');
var contactno = $(this).data('contactno');
var email = $(this).data('email');
var password = $(this).data('password');

$(".pid").val(id);
$(".pname").val(name);
$(".paddress").val(address);
$(".pcontactno").val(contactno);
$(".pemail").val(email);
$(".ppassword").val(password);
});
</script>

<script>
 
</script>

<script>
$(document).ready(function () {

$('#patientform').validate({ 
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

$('#patienteditform').validate({ // initialize the plugin
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