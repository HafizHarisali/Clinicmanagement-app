<?php ob_start();?>
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
    <div class="card shadow mb-4 showappoint">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold" style="color: #185479;">Your Appointments</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead style="background-color: #185479;color: white;">
            <tr>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Date</th>
              <th>Time</th>
              
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Date</th>
              <th>Time</th>
              
            </tr>
          </tfoot>
          <tbody>
            <?php 
            require_once('../../Clinicmanagement/controllers/appointmentscontroller.php');
            $appointment=new appointment;
            $today = date("Y-m-d"); 
            $check=$appointment->getpatientappoint();
            while($row=$check->fetch()) {
             if($today < $row["Date"]){
              ?>
            <tr>
              <td><?php echo $row["Patientname"]?></td>
              <td><?php echo $row["Doctorname"]?></td>
              <td><?php echo $row["Date"]?></td>
              <td><?php echo $row["Time"]?></td>
             
            </tr>
          <?php } } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

