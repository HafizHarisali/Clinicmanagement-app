<?php ob_start();?>
    <?php include('../../Clinicmanagement/layouts/navbar.php')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
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
                <!-- Topbar -->
                <?php include('../../Clinicmanagement/layouts/topbar.php')?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"></h1>
                            <a href="#" class="btn btn-sm shadow-sm btnaddtreatment" style="background-color: #185479;color: white;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Treatment</a>
                            <a href="#" class="btn btn-sm shadow-sm btnshowtreatment" style="background-color: #185479;color: white;display: none;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Show Treatment</a>
                        </div>
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8 col-lg-8 addtreatment" style="display: none;">
                                <div class="card shadow mb-4">
                                    <!-- Card Header -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold cardheading">Add Treatments</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <form method="post" id="treatmentform">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                    <label>Patient Name</label>
                                                    <select name="patientname" class="form-control">
                                                        <?php
                         require('../../Clinicmanagement/controllers/treatmentscontroller.php');
                         $treatments=new treatments;
                         $select=$treatments->getpatientfortreat();
                         while ($row=$select->fetch()) {?>
                                                            <option value="<?php echo $row["Id"]?>">
                                                                <?php echo $row["Name"]?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>

                                                    <label class="mt-3">Doctor Name</label>
                                                    <select name="doctorname" class="form-control">
                                                        <?php
                         $select1=$treatments->getdoctorsfortreat();
                         while ($row=$select1->fetch()) {?>
                                                            <option value="<?php echo $row["Id"]?>">
                                                                <?php echo $row["Name"]?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>

                                                    <label class="mt-3">Prescription</label>
                                                    <textarea id="message" class="form-control" placeholder="Prescription" rows="6" name="prescription"></textarea>

                                                    <label class="mt-3">Cost</label>
                                                    <input type="number" name="cost" class="form-control">

                                                    <label class="mt-3">Start Date</label>
                                                    <input type="date" name="startdate" class="form-control">

                                                    <label class="mt-3">End Date</label>
                                                    <input type="date" name="enddate" class="form-control">

                                                    <button class="btn btn-block mt-3" type="submit" name="btnsubmittreat">Add Treatment</button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: 30px;">

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2"></div>
                        </div>

                        <?php
          if(isset($_POST["btnsubmittreat"]))
          {
            $treatments->addtreatments($_POST["patientname"],$_POST["doctorname"],$_POST["prescription"],
                                       $_POST["cost"],$_POST["startdate"],$_POST["enddate"]);
            echo "<script>swal('Added Successfully!','success');</script>";
          }

          ?>
                            <script>
                                var today = new Date().toISOString().split('T')[0];
                                document.getElementsByName("startdate")[0].setAttribute('min', today);

                                var end = new Date().toISOString().split('T')[0];
                                document.getElementsByName("enddate")[0].setAttribute('min', end);
                            </script>
                            <div class="card shadow mb-4 showtreatment">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: #185479;">Treatments</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                            <thead style="background-color: #185479;color: white;">
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Doctor Name</th>
                                                    <th>Prescription</th>
                                                    <th>Cost</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Doctor Name</th>
                                                    <th>Prescription</th>
                                                    <th>Cost</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
            $totaltreatments=$treatments->gettreatments();
            $name="";
            $today = date("Y-m-d"); 

            while ($row=$totaltreatments->fetch()) {
                if($today < $row["Enddate"]){
                ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo $row["PatientName"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row["DoctorName"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row["Prescription"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row["Cost"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row["Startdate"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row["Enddate"]?>
                                                        </td>
                                                        <td class="dropdown no-arrow">
                                                            <a class="dropdown-toggle ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h fa-sm fa-fw" style="font-size: 18px;color:#185479;"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                <a href="#" class="dropdown-item edit_btn" data-toggle="modal" data-target="#logoutModal" data-patientname="<?php echo $row['Patientid'];?>" data-doctorname="<?php echo $row['Doctorid'];?>" data-prescription="<?php echo $row['Prescription'];?>" data-cost="<?php echo $row['Cost']; ?>" data-strtdate="<?php echo $row['Startdate']; ?>"data-endate="<?php echo $row['Enddate']; ?>" data-id="<?php echo $row['Id'];?>">
                                                                     Edit</a>
                                                                <a class="dropdown-item" href="<?php echo 'treatments.php?action=delete&id='.$row['Id'] ?>">Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
if(isset($_GET['action']))
{
  if($_GET['action']=='delete')
  {
    $id=$_GET['id'];
   $treatments->deletetreatments();
    header('location:treatments.php');
  }
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Treatment</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="treatmenteditform">
                            <div class="form-row mb-1">
                                <input type="hidden" name="id" class="pid">
                                <label><span>Patient Name</span></label>
                                <select name="patientname" class="form-control pname">
                                    <?php
                         $treatments=new treatments;
                         $select=$treatments->getpatientfortreat();
                         while ($row=$select->fetch()) {?>
                                        <option id="sel" value="<?php echo $row["Id"]?>">
                                            <?php echo $row["Name"]?>
                                        </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-row mb-1">
                                <label><span>Doctor Name</span></label>
                                <select style="width: 676px;" name="doctorname" class="form-control dname">
                                    <?php
                         $select1=$treatments->getdoctorsfortreat();
                         while ($row=$select1->fetch()) {?>
                                        <option id="seld" value="<?php echo $row["Id"]?>">
                                            <?php echo $row["Name"]?>
                                        </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <label><span>Prescription</span></label>
                                <textarea rows="8" cols="10" name="prescription" class="form-control ppres"></textarea>

                            </div>
                            <div class="form-row">
                                <label><span>Cost</span></label>
                                <input type="number" name="cost" placeholder=" " required="" class="form-control pcost" />
                            </div>

                            <div class="form-row">
                                <label><span>Start Date</span></label>
                                <input type="date" name="startdate" placeholder=" " required="" class="form-control pstartdate" />
                            </div>

                            <div class="form-row">
                                <label><span>End Date</span></label>
                                <input type="date" name="enddate" placeholder=" " required="" class="form-control penddate" />
                            </div>
                            <!-- <div class="form-row">
                    <label class="pure-material-textfield-outlined">
                      <input type="date" name="datetime" placeholder=" " required="" style="width: 676px;" />
                    <span style="width: 676px;">Date</span>
                    </label>
                    </div> -->

                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-top: 30px;">
                                        <button class="btn ripple-effect" type="submit" name="btnedittreat" style="width: 100%;color:white;background-color: #185479;">Update Treatment</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php 
        if(isset($_POST["btnedittreat"]))
        {
          $treatments->updatetreatments($_POST["id"],$_POST["patientname"],$_POST["doctorname"],$_POST["prescription"],$_POST["cost"],$_POST["startdate"],$_POST["enddate"]);
          header('location:treatments.php');
        }
        ?>

                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).on("click", '.edit_btn', function(e) {
                var patientname = $(this).data('patientname');
                var id = $(this).data('id');
                var doctorname = $(this).data('doctorname');
                var prescription = $(this).data('prescription');
                var cost = $(this).data('cost');
                var strtdate = $(this).data('strtdate');
                var enddate = $(this).data('endate');

                $('#sel').each(function() {
                    if (this.value == patientname) {
                        this.setAttribute('selected', 'selected');
                    }
                });

                $('#seld').each(function() {
                    if (this.value == doctorname) {
                        this.setAttribute('selected', 'selected');
                    }
                });
                $(".dname").val(doctorname);
                $(".pname").val(patientname);
                $(".ppres").val(prescription);
                $(".pcost").val(cost);
                $(".pid").val(id);
                $(".pstartdate").val(strtdate);
                $(".penddate").val(enddate);
            });
        </script>

         <script>
               $(document).ready(function () {

                      $('#treatmentform').validate({ 
                          rules: {
                              patientname: {
                                  required: true,
                                
                              },
                              doctorname: {
                                  required: true,
                                  
                              },

                              prescription:{
                                required:true,
                              },

                              cost:{
                                required:true,
                                numbersOnly:true
                                
                              },

                              startdate:{
                                required:true,
                              },

                               enddate:{
                                required:true,
                              },

                          }
                      });

                       $('#treatmenteditform').validate({ 
                          rules: {
                              patientname: {
                                  required: true,
                                
                              },
                              doctorname: {
                                  required: true,
                                  
                              },

                              prescription:{
                                required:true,
                              },

                              cost:{
                                required:true,
                                numbersOnly:true
                                
                              },

                              startdate:{
                                required:true,
                                date:true
                              },

                               enddate:{
                                required:true,
                                date:true
                              },

                          }
                      });

                  });
            </script>