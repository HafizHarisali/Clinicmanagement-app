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
                       
                      

                    
                            <div class="card shadow mb-4 showappoint">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6"><h6 class="m-0 font-weight-bold" style="color: #185479;">All Appointments Report</h6></div>
                                    
                                    <div class="col-md-6 text-right"><button id="printbtn" class="btn">Print</button></div>
                                    
                                </div>
                            </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
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
                require('../../Clinicmanagement/controllers/appointmentscontroller.php');
                $appointment=new appointment;                                  
                $select2=$appointment->getappointments();
                
                while($row1=$select2->fetch()) { 
                   
                    ?>                      <tr>
                                                        <td>
                                                            <?php echo $row1["Patientname"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row1["Doctorname"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row1["Date"]?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row1["AppointmentTime"]?>
                                                        </td>
                                                       
                                                    </tr>
                                                    <?php } ?>
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
      <script type="text/javascript">
          $(document).ready(function(){
            $('#dataTable1').dataTable({
                sorting:false,
            })
          });

          function printData()
        {
           var divToPrint=document.getElementById("dataTable1");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }

        $('#printbtn').on('click',function(){
        printData();
        })
      </script>
       