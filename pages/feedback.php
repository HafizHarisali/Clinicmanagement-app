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



<div class="card shadow mb-4 showpatient">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold" style="color: #185479;">Patient Feedback</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead style="background-color: #185479;color: white;">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                require('../../Clinicmanagement/controllers/queriescontroller.php');
                $feedback=new feedback;
$query=$feedback->getfeedback();
while($row=$query->fetch()) { ?>
                    <tr>
                        <td>
                            <?php echo $row["Name"];?>
                        </td>
                        <td>
                            <?php echo $row["Email"];?>
                        </td>
                        <td>
                            <?php echo $row["Message"];?>
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

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

