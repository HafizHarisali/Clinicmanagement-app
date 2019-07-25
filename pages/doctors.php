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
        #doctorform label.error {
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

                    <?php 
          require('../../Clinicmanagement/controllers/doctorscontroller.php');
          $doctors=new doctors;
          if(isset($_POST["btnsubmitdoctor"]))
          {
              $db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
                $checkquery=$db->query("SELECT Email from doctors");
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
                  
                $days=implode(",",$_POST["days"]);
                $doctors->adddoctor("Dr.".$_POST["name"],$_POST["address"],$_POST["contactno"],$_POST["email"],$_POST["password"],
                                  $_POST["gender"],$days,$_POST["starttime"],$_POST["endtime"]);
                echo "<script>swal('Doctor Added Successfully!','success');</script>";
          }
      }
          ?>

                        <div class="container-fluid">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"></h1>
                                <a href="#" class="btn btn-sm shadow-sm btnadddoctor" style="background-color: #185479;color: white;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Doctors</a>
                                <a href="#" class="btn btn-sm shadow-sm btnshowdoctor" style="background-color: #185479;color: white;display: none;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Show Doctors</a>
                                <?php
            if(isset($_GET['action']))
            {
              if($_GET['action']=='delete')
              {
                $id=$_GET['id'];
               $doctors->deletedoctors();
                $msg="Doctor deleted Successfully";
                header('location:doctors.php');

              }
            }
          ?>
                                    <?php if(isset($msg))
          {
            echo $msg;
          }?>
                            </div>
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8 col-lg-8 adddoctor" style="display: none;">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold cardheading">Add Doctors</h6>
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <form id="doctorform" method="post">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control">

                                                        <label class="mt-3">Address</label>
                                                        <input type="text" name="address" class="form-control">

                                                        <label class="mt-3">Contact No</label>
                                                        <input type="number" name="contactno" class="form-control">

                                                        <label class="mt-3">Email</label>
                                                        <input type="email" name="email" class="form-control">

                                                        <label class="mt-3">Password</label>
                                                        <input type="text" name="password" class="form-control">

                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <p style="margin-top: 18px;"><b>Gender :</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="md-radio">
                                                                    <input id="1" type="radio" name="gender" value="male" checked="">
                                                                    <label for="1">Male</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="md-radio">
                                                                    <input id="2" type="radio" name="gender" value="female">
                                                                    <label for="2">Female</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="mt-3">Most Convinient Days</label>
                                                        <div class="form-row">
                                                            <div style="margin-left: 30px;">
                                                                <input type="checkbox" class="custom-control-input check" id="customCheck1" name="days[]" value="Monday">
                                                                <label class="custom-control-label" for="customCheck1">Mondays</label>
                                                            </div>
                                                            <div style="margin-left: 90px;">
                                                                <input type="checkbox" class="custom-control-input check" id="customCheck2" name="days[]" value="Tuesday">
                                                                <label class="custom-control-label" for="customCheck2">Tuesdays</label>
                                                            </div>
                                                            <div style="margin-left: 90px;">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="days[]" value="Wednesday">
                                                                <label class="custom-control-label" for="customCheck3">Wednesdays</label>
                                                            </div>
                                                            <div style="margin-left: 30px;" class="mt-2">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="days[]" value="Thursday">
                                                                <label class="custom-control-label" for="customCheck4">Thursdays</label>
                                                            </div>
                                                            <div style="margin-left: 82px;" class="mt-2">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="days[]" value="Friday">
                                                                <label class="custom-control-label" for="customCheck5">Fridays</label>
                                                            </div>
                                                            <div style="margin-left: 105px;" class="mt-2">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck6" name="days[]" value="Saturday">
                                                                <label class="custom-control-label" for="customCheck6">Saturdays</label>
                                                            </div>

                                                            <div class="col-md-6 mt-3">
                                                                <label>Start time</label>
                                                                <input type="time" name="starttime" class="form-control" id="timefrom">
                                                            </div>
                                                            <div class="col-md-6 mt-3">
                                                                <label>End time</label>
                                                                <input type="time" name="endtime" class="form-control" id="timeto">
                                                            </div>
                                                            <button class="btn btn-block mt-3" type="submit" name="btnsubmitdoctor">Add Doctor</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-9"></div>
                                                    <div class="col-md-3">
                                                        <div class="form-group" style="margin-top: 40px;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2"></div>
                            </div>

                            <div class="card shadow mb-4 showdoctor" style="width:1230px;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: #185479;">Doctors</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-responsive" id="dataTable" width="100%" cellspacing="0">
                                            <thead style="background-color: #185479;color: white;">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Gender</th>
                                                    <th>Days</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php 
            $select1=$doctors->getdoctors();
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
                                                            <?php echo $row["Gender"];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row["Days"];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['DATE_FORMAT(Starttime,"%r")'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['DATE_FORMAT(Endtime,"%r")'];?>
                                                        </td>
                                                        <td class="dropdown no-arrow">
                                                            <a class="dropdown-toggle ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h fa-sm fa-fw" style="font-size: 18px;color:#185479;"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                <a href="#" class="dropdown-item edit_btn" data-toggle="modal" data-target="#logoutModal" data-name="<?php echo $row['Name'];?>" data-address="<?php echo $row['Address'];?>" data-contactno="<?php echo $row['Contactno'];?>" data-email="<?php echo $row['Email']; ?>" data-password="<?php echo $row['Password'];?>" data-gender="<?php echo $row['Gender'];?>" data-days="<?php echo $row['Days'];?>" data-starttime="<?php echo $row['DATE_FORMAT(Starttime,"%r")'];?>" data-endtime="<?php echo $row['DATE_FORMAT(Endtime,"%r")'];?>" data-id="<?php echo $row['Id'];?>">
                    Edit</a>
                                                                <a class="dropdown-item" href="<?php echo 'doctors.php?action=delete&id='.$row['Id'] ?>">Delete</a>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Doctors</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <form method="post" id="doctoreditform">
                                    <div class="form-row">
                                        <input type="hidden" name="id" class="did" />
                                        <label><span>Full Name</span></label>
                                        <input type="text" name="name" class="dname form-control" />
                                    </div>
                                    <div class="form-row">
                                        <label><span>Address</span></label>
                                        <input type="text" name="address" placeholder=" " class="daddress form-control" />
                                    </div>
                                    <div class="form-row">
                                        <label><span>Contact Number</span></label>
                                        <input type="number" name="contactno" placeholder=" " class="dcontactno form-control" />
                                    </div>
                                    <div class="form-row">
                                        <label><span>Email</span></label>
                                        <input type="email" name="email" placeholder=" " required="" class="demail form-control" />
                                    </div>
                                    <div class="form-row">
                                        <label><span>Password</span></label>
                                        <input type="password" name="password" placeholder=" " required="" class="dpassword form-control" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p style="margin-top: 18px;"><b>Gender :</b></p>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="md-radio">
                                                <input id="3" type="radio" name="gender" value="male" class="dgender">
                                                <label for="3">Male</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="md-radio">
                                                <input id="4" type="radio" name="gender" value="female" class="dgender1">
                                                <label for="4">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <p><b>Most Convienient Days Of week :</b></p>
                                    </div>
                                    <div class="form-row">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input ddays" id="customCheck7" name="days1[]" value="Monday">
                                            <label class="custom-control-label" for="customCheck7">Mondays</label>
                                        </div>
                                        <div class="custom-control custom-checkbox small ml-3">
                                            <input type="checkbox" class="custom-control-input ddays" id="customCheck8" name="days1[]" value="Tuesday">
                                            <label class="custom-control-label" for="customCheck8">Tuesdays</label>
                                        </div>
                                        <div class="custom-control custom-checkbox small ml-3">
                                            <input type="checkbox" class="custom-control-input ddays" id="customCheck9" name="days1[]" value="Wednesday">
                                            <label class="custom-control-label" for="customCheck9">Wednesdays</label>
                                        </div>
                                        <div class="custom-control custom-checkbox small ml-3">
                                            <input type="checkbox" class="custom-control-input ddays" id="customCheck0" name="days1[]" value="Thursday">
                                            <label class="custom-control-label" for="customCheck0">Thursdays</label>
                                        </div>
                                        <div class="custom-control custom-checkbox small ml-3">
                                            <input type="checkbox" class="custom-control-input ddays" id="customCheck11" name="days1[]" value="Friday">
                                            <label class="custom-control-label" for="customCheck11">Fridays</label>
                                        </div>
                                        <div class="custom-control custom-checkbox small ml-0">
                                            <input type="checkbox" class="custom-control-input ddays" id="customCheck12" name="days1[]" value="Saturday">
                                            <label class="custom-control-label" for="customCheck12">Saturdays</label>
                                        </div>
                                    </div>
                                    <p class="mt-3"><b>Time Slots</b></p>
                                    <div class="row mb-1 mt-3">
                                        <div class="col-md-6">
                                            <label><span>Start Time</span></label>
                                            <input type="text" name="starttime" id="timefrom1" placeholder=" " required="" class="form-control dstime" />
                                        </div>
                                        <div class="col-md-6">
                                            <label><span>End Time</span></label>
                                            <input type="text" name="endtime" id="timeto1" placeholder=" " required="" class="form-control detime" />
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit" name="btneditdoctor">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <?php
                            if(isset($_POST['btneditdoctor']))
                            {
                              $days1=implode(",",$_POST["days1"]);
                            $doctors->updatedoctors($_POST['id'],$_POST['name'],$_POST['address'],$_POST['email'],$_POST['password'],$_POST['contactno'],$_POST['gender'],$days1,$_POST["starttime"],$_POST["endtime"]);
                            header('location:doctors.php');
                            }

?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).on("click", '.edit_btn', function(e) {
                var name = $(this).data('name');
                var id = $(this).data('id');
                var address = $(this).data('address');
                var contactno = $(this).data('contactno');
                var email = $(this).data('email');
                var password = $(this).data('password');
                var gender = $(this).data('gender');
                var days = $(this).data('days');
                var starttime = $(this).data('starttime');
                var endtime = $(this).data('endtime');

                $(".did").val(id);
                $(".dname").val(name);
                $(".daddress").val(address);
                $(".dcontactno").val(contactno);
                $(".demail").val(email);
                $(".dpassword").val(password);
                if (gender == "male") {
                    $(".dgender").attr("checked", "checked");
                } else {
                    $(".dgender1").attr("checked", "checked");
                }

               
                $(".dstime").val(starttime);
                $(".detime").val(endtime);
            });
        </script>

 <script>
               $(document).ready(function () {

                      $('#doctorform').validate({ 
                          rules: {
                              name: {
                                  required: true,
                                  lettersOnly:true,
                                  minLength:3
                              },
                              address: {
                                  required: true,
                                  
                              },

                              contactno:{
                                required:true,
                                numbersOnly:true
                              },

                              email:{
                                required:true,
                                
                                
                              },

                              password:{
                                required:true,
                              },

                              days:{
                                required:".check:checked",
                              }

                          }
                      });

                       $('#doctoreditform').validate({ 
                          rules: {
                              name: {
                                  required: true,
                                  lettersOnly:true
                                  minLength:3
                              },
                              address: {
                                  required: true,
                                  
                              },

                              contactno:{
                                required:true,
                                numbersOnly:true
                              },

                              email:{
                                required:true,
                                
                                
                              },

                              password:{
                                required:true,
                              },

                             

                          }
                      });

                  });
            </script>