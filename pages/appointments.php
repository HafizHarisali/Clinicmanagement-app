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

              #appointmentform label.error {
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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"></h1>
                            <a href="#" class="btn btn-sm shadow-sm btnaddappoint" style="background-color: #185479;color: white;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Set Appointment</a>
                            <a href="#" class="btn btn-sm shadow-sm btnshowappoint" style="background-color: #185479;color: white;display: none;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Show Appointments</a>
                        </div>
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8 col-lg-8 addappoint" style="display: none;">
                                <div class="card shadow mb-4">
                                    <!-- Card Header -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold cardheading">Set Appointment</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Card Body -->

                                    <div class="card-body">
                                        <form method="post" id="appointmentform">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                    <label>Patient Name</label>
                                                    <select name="patientname" class="form-control">
                                                        <?php
                        require('../../Clinicmanagement/controllers/appointmentscontroller.php');
                        $appointment=new appointment;
                         $select=$appointment->getpatientforappointments();
                         while ($row=$select->fetch()) { ?>
                                                            <option value="<?php echo $row["Id"]?>">
                                                                <?php echo $row["Name"]?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>

                                                    <label class="mt-3">Doctor Name</label>
                                                    <select name="doctorname" id="doctorid" onchange="GetTimeSlots();" class="form-control">
                                                        <?php
                         $select1=$appointment->getdoctorsforappointments();
                         while ($row=$select1->fetch()) {?>
                                                            <option value="<?php echo $row["Id"]?>" class="doctoroption">
                                                                <?php echo $row["Name"]?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>

                                                    <label class="mt-3">Date</label>
                                                    <input type="date" name="date" class="form-control">

                                                    <label class="mt-3">Time Slot</label>
                                                    <select name="timeslot" id="timeslots" class="form-control">

                                                    </select>
                                                    
                                                    <button class="btn btn-block mt-3" name="btnsetappoint" type="submit">Set Appointment</button>
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
                            <script>
                                var today = new Date().toISOString().split('T')[0];
                                document.getElementsByName("date")[0].setAttribute('min', today);
                            </script>
                        <?php
          if(isset($_POST["btnsetappoint"]))
          {
           $doctorid = $_POST["doctorname"];
           $patientid = $_POST["patientname"];
           $date=$_POST["date"];
           $time=$_POST["timeslot"];
           //$time1=date('h:i',strtotime($time));

            $db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');
            //Check Appointment Already
            $check_app=$db->query("SELECT Time AS Appointime,Date,Statusid FROM appointments WHERE Doctorid='".$doctorid."'");

            while($fetch_row=$check_app->fetch())
            {
              if($date==$fetch_row["Date"] && $time==$fetch_row["Appointime"] && $fetch_row["Statusid"]==1)
                {
                  $error =  "error";
                  //break;

                }

            else if($date==$fetch_row["Date"] && $time==$fetch_row["Appointime"] && $fetch_row["Statusid"]==2){

                $successa="success";

                }

                else{

                   $success = "success";
                   //break;
                }

            }

            if(!empty($error)){
              echo "<script>swal('Appointment Already Booked at this timeslot!','warning');</script>";
            }

            else if(!empty($successa))
            {
                $patient_mail="SELECT Name, Email From users WHERE Id=".$patientid;
            $match=$db->query($patient_mail);
            $rows=$match->fetch();
            //Doctors Match
            $querymatch="SELECT Id,Name,Days,DATE_FORMAT(Starttime,'%r'),DATE_FORMAT(Endtime,'%r') FROM doctors WHERE Id=".$doctorid;
            $select=$db->prepare($querymatch);
            $select->execute();
            $row=$select->fetch();

            if($row==true)
            {
              $name=$row["Name"];
              $days=$row["Days"];
              // $array=array($days);
              $exp=explode(",",$days);

              $date1=date('l', strtotime($date));

              foreach($exp as $key){
             if($date1==$key)
             {
                $sucess1 = "<script>swal('Doctor Is not Available at this date!','error');</script>";
            
               }

               else{
                $error1="error";
               }

              }

              if(!empty($sucess1))
              {
                 $appointment->addappointments1($_POST["patientname"],$doctorid,$_POST["date"],$_POST["timeslot"],1);

                //Mail Sending Code
                require('../../Clinicmanagement/vendor/autoload.php');
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('harisalihafiz123@gmail.com')
                ->setPassword('urbanlife!@#$%');
                $mailer = new Swift_Mailer($transport);
                $body ='';
                $message = (new Swift_Message('Email Through Dental Clinic'))
                ->setFrom(['harisalihafiz123@gmail.com' => 'Haris Ali'])
                ->setTo($rows["Email"])
                ->setBody($body)
                ->setContentType('text/html');
                $mailer->send($message);
                echo "<script>swal('Added Successfully!','success');</script>";
                
              }

              else{
               echo "<script>swal('Doctor Is not Available at this date!','error');</script>";
              }

              }
            }
            else
            {
            $patient_mail="SELECT Name,Email From users WHERE Id=".$patientid;
            $match=$db->query($patient_mail);
            $rows=$match->fetch();
            //Doctors Match
            $querymatch="SELECT Id,Name,Days,DATE_FORMAT(Starttime,'%r'),DATE_FORMAT(Endtime,'%r') FROM doctors WHERE Id=".$doctorid;
            $select=$db->prepare($querymatch);
            $select->execute();
            $row=$select->fetch();

            if($row==true)
            {
              $name=$row["Name"];
              $days=$row["Days"];
              // $array=array($days);
              $exp=explode(",",$days);

              $date1=date('l', strtotime($date));

              foreach($exp as $key){
             if($date1==$key)
             {
                $sucess1 = "<script>swal('Doctor Is not Available at this date!','error');</script>";
            
               }

               else{
                $error1="error";
               }

              }

              if(!empty($sucess1))
              {
                 $appointment->addappointments1($_POST["patientname"],$doctorid,$_POST["date"],$_POST["timeslot"],1);

                //Mail Sending Code
                require('../../Clinicmanagement/vendor/autoload.php');
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('harisalihafiz123@gmail.com')
                ->setPassword('urbanlife!@#$%');
                $mailer = new Swift_Mailer($transport);
                $body ='<body style="margin: 0 !important; padding: 0 !important;">
<!-- HEADER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#fafafa" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                        <a href="#" target="_blank">
                            
                        </a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#fafafa" align="center" style="padding: 15px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy">DENTAL CLINIC MANAGEMENT</td>
                            </tr>
                            <tr>
                                <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Dentistry, also known as Dental and Oral Medicine, is a branch of medicine that consists of the study, diagnosis, prevention, and treatment of diseases, disorders, and conditions of the oral cavity</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#fafafa" align="center" style="padding: 15px;" class="padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    

                    <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
                    Dear '.$rows["Name"].'
                        <!-- TWO COLUMNS -->
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td valign="top" class="mobile-wrapper">
                                    <!-- LEFT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Your Appointment is Fixed at</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- RIGHT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="right" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">'.$date.' '.$time.'</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- TWO COLUMNS -->
                        
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0 0px 0; border-top: 1px solid #eaeaea; border-bottom: 1px dashed #aaaaaa;">
                        <!-- TWO COLUMNS -->
                       
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#fafafa" align="center" style="padding: 15px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="left" style="padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;" class="padding-copy">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed varius, leo a ullamcorper feugiat, ante purus sodales justo, a faucibus libero lacus a est. Aenean at mollis ipsum.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        
    </tr>
    <tr>
        <td bgcolor="#fafafa" align="center" style="padding: 20px 0px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <!-- UNSUBSCRIBE COPY -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                        1234 Main Street, Anywhere, MA 01234, USA
                        <br>
                        <a href="http://litmus.com" target="_blank" style="color: #666666; text-decoration: none;">Unsubscribe</a>
                        <span style="font-family: Arial, sans-serif; font-size: 12px; color: #444444;">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a href="http://litmus.com" target="_blank" style="color: #666666; text-decoration: none;">View this email in your browser</a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>

</body>';
                $message = (new Swift_Message('Email Through Dental Clinic'))
                ->setFrom(['harisalihafiz123@gmail.com' => 'Haris Ali'])
                ->setTo($rows["Email"])
                ->setBody($body)
                ->setContentType('text/html');
                $mailer->send($message);
                echo "<script>swal('Added Successfully!','success');</script>";
                
              }

              else{
               echo "<script>swal('Doctor Is not Available at this date!','error');</script>";
              }

              }

            //Patients Mail Get
            // else{

            //  }

            }
            }

          ?>

                            <div class="card shadow mb-4 showappoint">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: #185479;">Current Appointments</h6>
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
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Doctor Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php 
            $select2=$appointment->getappointments();
            $today = date("Y-m-d"); 
            while($row1=$select2->fetch()) { 
                if($today < $row1["Date"]){
                ?>
                                                    <tr>
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
                                                        <td>
                                                            <?php echo $row1["Status"]?>
                                                        </td>
                                                        <td class="dropdown no-arrow">
                                                            <a class="dropdown-toggle ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h fa-sm fa-fw" style="font-size: 18px;color:#185479;"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                <a href="#" class="dropdown-item edit_btn_ap" 
                                                                data-toggle="modal" data-target="#EditModal"
                                                                data-patientname="<?php echo $row1['Patientid'];?>" 
                                                                data-doctorname="<?php echo $row1['Doctorid'];?>"
                                                                data-date="<?php echo $row1['Date'];?>"
                                                                data-time="<?php echo $row1['AppointmentTime'];?>"
                                                                data-status="<?php echo $row1['AppointStatusid'];?>"
                                                                data-id="<?php echo $row1['Id'];?>"
                                                                >Edit</a>
                                                                <a class="dropdown-item" href="#">Delete</a>
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

            <!-- Footer -->
            <?php include('../../Clinicmanagement/layouts/footer.php') ?>
                <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
        <script>
            $(document).ready(function() {
                GetTimeSlots();
                GetEditTimeSlots();
            })
        </script>

        <script type="text/javascript">
            function GetTimeSlots() {
                var doctorid = document.getElementById('doctorid').value;
                var Slot_Temp = $('#slot_temp').html();

                $.getJSON('http://localhost:82/ClinicManagement/classes/patientclass.php?id=' + doctorid, null, function(slot) {
                    var slots = "";
                    for (var i = 0; i < slot.length; i++) {
                        slots += Slot_Temp.replace('{{Slots}}', slot[i].Slots).replace('{{Slots}}', slot[i].Slots)
                    }
                    $('#timeslots').html(slots);
                });
            }
        </script>
        <script type="text/html" id="slot_temp">

            <option value="{{Slots}}">{{Slots}}</option>

        </script>


         <script type="text/javascript">
            function GetEditTimeSlots() {
                var doctorid = document.getElementById('doctoridedit').value;
                var Slot_Temp = $('#slot_temp_edit').html();

                $.getJSON('http://localhost:82/ClinicManagement/classes/patientclass.php?id=' + doctorid, null, function(slot) {
                    var slots = "";
                    for (var i = 0; i < slot.length; i++) {
                        slots += Slot_Temp.replace('{{Slots}}', slot[i].Slots).replace('{{Slots}}', slot[i].Slots)
                    }
                    $('#timeslotsedit').html(slots);
                });
            }
        </script>
        <script type="text/html" id="slot_temp_edit">

            <option id="slotsid" value="{{Slots}}">{{Slots}}</option>

        </script>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
       <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <form method="post">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                    <input type="hidden" name="id" class="apid">
                                                    <label style="display: none;">Patient Name</label>
                                                    <select style="display: none;" name="patientname" class="form-control patientname">
                                                        <?php
                      
                        
                         $select=$appointment->getpatientforappointments();
                         while ($row=$select->fetch()) { ?>
                                                            <option id="sel" value="<?php echo $row["Id"]?>">
                                                                <?php echo $row["Name"]?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>

                                                    <label style="display: none;" class="mt-3">Doctor Name</label>
                                                    <select style="display: none;" name="doctorname" id="doctoridedit"  onchange="GetEditTimeSlots();" class="form-control doctorname">
                                                        <?php
                         $select1=$appointment->getdoctorsforappointments();
                         while ($row=$select1->fetch()) {?>
                                                            <option id="seld" value="<?php echo $row["Id"]?>" class="doctoroption">
                                                                <?php echo $row["Name"]?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>

                                                    <label style="display: none;" class="mt-3">Date</label>
                                                    <input style="display: none;" type="date" name="date" class="form-control date">

                                                    <label style="display: none;" class="mt-3">Time Slot</label>
                                                    <select style="display: none;" name="timeslot" id="timeslotsedit" class="form-control timeslots">

                                                    </select>
                                                    
                                                    <label class="mt-3">Status</label>
                                                    <select class="form-control status" name="status">
                                                        <?php 
                                                        $select=$appointment->getstatus();
                                                        while($row=$select->fetch()){?>
                                                        <option id="statusopt" value="<?php echo $row['Id'] ?>"><?php echo $row["Status"]?></option>
                                                    <?php }?>
                                                    </select>

                                                    <button class="btn btn-block mt-3" name="btneditappoint" type="submit">Set Appointment</button>
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
        </div>

        <?php 

        if(isset($_POST["btneditappoint"]))
        {

            $appointment->updateappointments1($_POST["id"],$_POST["patientname"],$_POST["doctorname"],$_POST["date"],$_POST["timeslot"],$_POST["status"]);
        
            header('location:appointments.php');
}
        ?>

         <script>
            $(document).on("click", '.edit_btn_ap', function(e) {



                var patientname = $(this).data('patientname');
                var id = $(this).data('id');
                var doctorname = $(this).data('doctorname');
                var date = $(this).data('date');
                var time = $(this).data('time');
                var status = $(this).data('status');
                
                 

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

                 $('#statusopt').each(function() {

                    if (this.value == status) {
                        this.setAttribute('selected', 'selected');
                    }
                });



                 $('#slotsid').each(function() {

                    if (this.value == time) {
                        this.setAttribute('selected', 'selected');

                    }
                });

                  $(".apid").val(id);
                  $(".patientname").val(patientname);
                  $(".doctorname").val(doctorname);
                  $(".date").val(date);
                  $(".timeslots").val(time);
                  $(".status").val(status);

                  
               
            });

              $(document).ready(function () {

                      $('#appointmentform').validate({ 
                          rules: {
                              date: {
                                  required: true,
                                  date:true
                              },
                              
                          }
                      });

                      

                  });
        </script>