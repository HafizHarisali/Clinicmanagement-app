<?php ob_start();?>
    <?php include('../../Clinicmanagement/layouts/navbar.php')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
<style>
    .fc-title{color:white;}
</style>
            <!-- Main Content -->
            <div id="content">
             
                <!-- Topbar -->
                <?php include('../../Clinicmanagement/layouts/topbar.php')?>
                    <!-- End of Topbar -->

                    <div class="container">
                        <div class="card p-5">
                            <div id="calendar"></div>
                        </div>
                    </div>

  <?php include('../../Clinicmanagement/layouts/footer.php') ?>
                    <!-- End of Footer -->


        </div>
        <!-- End of Content Wrapper -->
 <script>
                  $(document).ready(function(){

                    var calendar=$('#calendar').fullCalendar({
                        
                        header:{
                            left:'prev,next,today',
                            center:'title',
                            right:'month,agendaWeek'
                        },

                       events:'loadappointments.php',
                                           
                    });
                  })
              </script>
        </div>
