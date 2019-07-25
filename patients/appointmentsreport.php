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
         
           <div class="card shadow mb-4 showtreatment">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold" style="color: #185479;">Your Treatment Report</h6>
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
            require('../../Clinicmanagement/controllers/treatmentscontroller.php');
            $treatments=new treatments;
            $check=$treatments->gettreatmentreport($_GET["id"]);
             
            while ($row=$check->fetch()) { ?>
              
            <tr>
              <td><?php echo $row["Patientname"]?></td>
              <td><?php echo $row["Doctorname"]?></td>
              <td><?php echo $row["Date"]?></td>
              <td><?php echo $row["Time"]?></td>
             
            </tr>
          <?php } ?>
          </tbody>
        </table>
         <div id="user_model_details"></div>
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
<!-- <script>
  $('.report').click(function(){
    $('#reporttr').toggle( function(){
       $('#reporttr').animate({
      height: "140", 
      padding:"10px 0",
      color:'white',
      backgroundColor:'#185479',
      opacity:.8
}, 500);

    });
  });
</script>
 -->  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 
 