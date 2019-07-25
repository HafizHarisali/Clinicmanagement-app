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

                </style>
                <!-- Topbar -->
                <?php include('../../Clinicmanagement/layouts/topbar.php')?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                
                            <div class="card shadow mb-4 showtreatment">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6"><h6 class="m-0 font-weight-bold" style="color: #185479;">All Treatment Report</h6></div>
                                    
                                    <div class="col-md-6 text-right"><button id="printbtn" class="btn">Print</button></div>
                                    
                                </div>
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
                                                    
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
            require('../../Clinicmanagement/controllers/treatmentscontroller.php');
            $treatments=new treatments;
            $totaltreatments=$treatments->gettreatments();
            while ($row=$totaltreatments->fetch()) {
               
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


                <!-- Footer -->
                <?php include('../../Clinicmanagement/layouts/footer.php') ?>
                    <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        </div>
      <script>
            function printData()
        {
           var divToPrint=document.getElementById("dataTable");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }

        $('#printbtn').on('click',function(){
        printData();
        })
      </script>