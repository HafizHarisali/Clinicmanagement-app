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
                                                    <select name="patientname" class="form-control" id="patientid" onchange="GetDoctors();">
                                                        <option>Select</option>
                        <?php
                        require_once('../../Clinicmanagement/controllers/appointmentscontroller.php');
                        $appointment=new appointment;
                         $select=$appointment->get_patients_against_treat();
                         $today = date("Y-m-d"); 
                         while ($row=$select->fetch()) {
                            if($today < $row["Enddate"]){
                          ?>                                
                                                            <option value="<?php echo $row["Patientid"]?>">
                                                                <?php echo $row["Patientname"]?>
                                                            </option>
                                                            <?php } } ?>
                                                    </select>

                                                    <label class="mt-3">Doctor Name</label>
                                                    <select name="doctorname" id="doctorid" onchange="GetTimeSlots();" class="form-control">     
                                                    </select>

                                                    <label class="mt-3">Date</label>
                                                    <input type="date" name="date" class="form-control">

                                                    <label class="mt-3">Time Slot</label>
                                                    <select name="timeslot" id="timeslots" class="form-control">

                                                    </select>

                                                    <label>
                                                        <select name="treatment" id="treatmentid" class="form-control" style="display: none;">
                                                            
                                                        </select>
                                                    </label>

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

                        <?php
          if(isset($_POST["btnsetappoint"]))
          {
           $doctorid = $_POST["doctorname"];
           $patientid = $_POST["patientname"];
           $date=$_POST["date"];
           $time=$_POST["timeslot"];
           //$time1=date('h:i',strtotime($time));

            $db = new PDO("mysql:host=localhost;dbname=dentalclinic",'root','');

            $treat=$db->query("SELECT * FROM treatments WHERE Patientid='".$patientid."'");
            $fetch_date=$treat->fetch();
            if($date >= $fetch_date["Startdate"] && $date <= $fetch_date["Enddate"])
            {
                  $check_app=$db->query("SELECT Time AS Appointime,Date FROM appointments WHERE Doctorid='".$doctorid."'");

            while($fetch_row=$check_app->fetch())
            {
              if($date==$fetch_row["Date"] && $time==$fetch_row["Appointime"])
                {
                  $error =  "error";
                  //break;

                }
                else{

                   $success = "success";
                   //break;
                }

            }

            if(!empty($error)){
              echo "<script>swal('Appointment Already fixed at this timeslot!','warning');</script>";
            }else
            {
            $patient_mail="SELECT Email From users WHERE Id=".$patientid;
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
                 $appointment->addappointments($_POST["patientname"],$doctorid,$_POST["date"],$_POST["timeslot"],$_POST["treatment"],1);

                //Mail Sending Code
                // require('../../Clinicmanagement/vendor/autoload.php');
                // $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                // ->setUsername('harisalihafiz123@gmail.com')
                // ->setPassword('urbanlife!@#$%');
                // $mailer = new Swift_Mailer($transport);
                // $body = "Your Appointment is fixed at ".$_POST["date"]. " " .$_POST["time"];
                // $message = (new Swift_Message('Email Through Dental Clinic'))
                // ->setFrom(['harisalihafiz123@gmail.com' => 'Haris Ali'])
                // ->setTo($rows["Email"])
                // ->setBody($body)
                // ->setContentType('text/html');
                // $mailer->send($message);
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

            else{
                echo "<script>swal('Sorry Your treatment date not match!','error');</script>";
            }

            }



            //Check Appointment Already
          
          ?>

                            <div class="card shadow mb-4 showappoint">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="color: #185479;">Appointments In Treatments</h6>
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
 
            $query=$appointment->get_appointments_against_treatments();
            $today = date("Y-m-d"); 
            while($row1=$query->fetch()) { 
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
                                                            <?php echo $row1["Time"]?>
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
        <script type="text/javascript">
            function GetDoctors() {
                var patientid = document.getElementById('patientid').value;
                var Doctor_temp = $('#doctornametemp').html();

                $.getJSON('http://localhost:82/ClinicManagement/classes/get_patients.php?id=' + patientid, null, function(doctor) {
                    var doctors = "";
                    for (var i = 0; i < doctor.length; i++) {
                        doctors += Doctor_temp.replace('{{Doctorid}}', doctor[i].Doctorid).replace('{{Doctorname}}', doctor[i].Doctorname)
                    }
                    $('#doctorid').html(doctors);
                });

                 var Treat_temp = $('#treattemp').html();

                $.getJSON('http://localhost:82/ClinicManagement/classes/get_patients.php?id=' + patientid, null, function(treat) {
                    var treats = "";
                    for (var i = 0; i < treat.length; i++) {
                        treats += Treat_temp.replace('{{Treatid}}', treat[i].Treatid).replace('{{Treatid}}', treat[i].Treatid)
                    }
                    $('#treatmentid').html(treats);
                });
            }
        </script>
        <script type="text/html" id="doctornametemp">
            <option value="">Select</option>
             <option value="{{Doctorid}}" >{{Doctorname}}</option>
        </script>

        
        <script type="text/html" id="treattemp">
            
             <option value="{{Treatid}}" >{{Treatid}}</option>
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
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
      <script>
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