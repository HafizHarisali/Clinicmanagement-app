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
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8 col-lg-8 addappoint" style="display: block;">

                                <div class="card shadow mb-4">
                                    <div class="card-header">
                                        <h3>Send Greeting Emails</h3></div>
                                    <div class="card-body">
                                        <form method="post">

                                            <div class="form-row">
                                                <label>Message</label>
                                                <textarea class="form-control" rows="10" name="message" required=""></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top: 30px;">
                                                        <button class="btn ripple-effect" name="btnsend" type="submit" style="width: 100%;color:white;background-color: #185479;">Send Message</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                 require_once('../../Clinicmanagement/controllers/mailcontroller.php');
                 if(isset($_POST["btnsend"]))
                 {
                    $obj=new mail;
                    $obj->sendemail($_POST["message"]);
                    echo "<script>swal('Email Sent Successfully!','success');</script>";
                 }
                 ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2"></div>
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