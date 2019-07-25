<?php ob_start();
error_reporting(E_ALL ^ E_NOTICE);
session_start();
?>
 <?php include('../../Clinicmanagement/layouts/navbar.php')?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       <?php include('../../Clinicmanagement/layouts/topbar.php')?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <?php if($_SESSION["Usertypeid"]==1){?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Current Month Profit / Loss</div>
                      <?php
                      require('../../Clinicmanagement/controllers/profitcontroller.php');
                      $profit=new profit_loss;
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rs. " .$profit->get_current_month_profit();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Overall Profit / Loss</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rs. ".$profit->overall_profit();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Patients</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                         
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $profit->get_patients_count();?></div>
                        </div>
                        <div class="col">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Doctors </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $profit->get_doctors_count();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-md fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php }?>
          <?php if($_SESSION["Usertypeid"]==2){?>
             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Treatments </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                      require('../../Clinicmanagement/controllers/profitcontroller.php');
                      $profit=new profit_loss;
                       echo $profit->get_patient_treatments_count();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-prescription fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Appointments </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $profit->get_patient_appointments_count();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php }?>
          <?php if($_SESSION["Days"]!=null){?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Treatments </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                       require('../../Clinicmanagement/controllers/profitcontroller.php');
                      $profit=new profit_loss;
                       echo $profit->get_doctor_treatments_count();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-prescription fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Appointments </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $profit->get_doctor_appointments_count();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php }?>
          </div>

          <!-- Content Row -->
          <?php if($_SESSION["Usertypeid"]==1){?>
          <div class="row">

            <!-- Area Chart -->
           

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Get Profit / Loss By Month</h6>
                  
                </div>

                <!-- Card Body -->
                <div class="card-body">
                  <h5 style="color: black;">Select Month</h5>
                   <form method="get">
                  <div class="row mt-4">
                  <div class="col-md-9">
                    <input type="month" name="month" class="form-control">
                  </div>
                  <div class="col-md-1">
                    <input type="submit" name="btngetmonth" class="btn btn-primary" value="Get">
                  </div>
                </div>
                 </form>
                 <hr>
                <?php if(isset($_GET["btngetmonth"])){ ?>
                  <p class="btn btn-primary btn-block"><?php echo $profit->get_month_profit($_GET["month"]);?></p>
                 <?php }?>

                </div>
              </div>
            </div>
          </div>
        <?php }?>
          <!-- Content Row -->
         

        </div>
        <!-- /.container-fluid -->

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
 

  <!-- Bootstrap core JavaScript-->
  

</body>

</html>
