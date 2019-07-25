<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard | Dental Clinic</title>

  <!-- Custom fonts for this template-->
  <link href="../../Clinicmanagement/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../Clinicmanagement/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../Clinicmanagement/admin/css/custom.css">
  <link href="../../Clinicmanagement/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Clinicmanagement/admin/css/sweetalert2.css">
 <script src="../../Clinicmanagement/admin/js/sweetalert2.js"></script>
<script src="../../Clinicmanagement/admin/js/moment.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">


  <style type="text/css">
    .page-item.active .page-link {
      background-color: #185479;
      border-color: #185479;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#185479;">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2" href="../../Clinicmanagement/pages/index.php">
       <img src="../../Clinicmanagement/images/logo1.png" width="155" height="120">
      </a>

      <!-- Divider -->


       <?php if($_SESSION["Usertypeid"]==1){?>

     <li class="nav-item active mt-3 ml-3">
        <a class="nav-link text-uppercase" href="#">
          <i class="fas fa-fw fa-user"  style="font-size: 20px;"></i>
          <span style="font-size: 20px;">Admin</span></a>
      </li>

      <li class="nav-item active mt-3">
        <a class="nav-link" href="../../Clinicmanagement/pages/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      
      <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/patients.php">
          <i class="fa fa-fw fa-user-injured"></i>
          <span>Patients</span></a>
      </li>

     
       <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/doctors.php">
          <i class="fas fa-fw fa-user-md"></i>
          <span>Doctors</span></a>
      </li>
  

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/treatments.php">
          <i class="fas fa-fw fa-prescription"></i>
          <span>Treatments</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppoint" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-calendar-check"></i>
          <span>Appointments</span>
        </a>
        <div id="collapseAppoint" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">  
            <a class="collapse-item" href="../../Clinicmanagement/pages/appointments.php">All</a>
            <a class="collapse-item" href="../../Clinicmanagement/pages/appointments-against-treatments.php">In Treatments</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/expenses.php">
          <i class="fas fa-fw fa-hand-holding-usd"></i>
          <span>Expenses</span></a>
      </li>

       <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/sendemail.php">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Send Greeting Emails</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/calendar.php">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Appointments Calendar</span></a>
      </li>

       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Reports</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">  
            <a class="collapse-item" href="../../Clinicmanagement/reports/appointments.php">Appointments</a>
            <a class="collapse-item" href="../../Clinicmanagement/reports/treatments.php">Treatments</a>
          </div>
        </div>
      </li>

       <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/pages/feedback.php">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Patient Feedback</span></a>
      </li>

    <?php } ?>
      <?php if($_SESSION["Usertypeid"]==2){?>

      <li class="nav-item active mt-3 ml-3">
        <a class="nav-link text-uppercase" href="#">
          <i class="fas fa-fw fa-user"  style="font-size: 20px;"></i>
          <span style="font-size: 20px;">Patient</span></a>
      </li>

       <li class="nav-item active mt-3">
        <a class="nav-link" href="../../Clinicmanagement/pages/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

       <li class="nav-item mt-2">
        <a class="nav-link" href="../../Clinicmanagement/patients/patientappoint.php">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Patient Appointments</span></a>
      </li>
    
       <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/patients/patienttreat.php">
          <i class="fas fa-fw fa-prescription"></i>
          <span>Patient Treatments</span></a>
      </li>
      <?php } ?>

       <?php if($_SESSION["Days"]!=null){?>



       <li class="nav-item active mt-3 ml-3">
        <a class="nav-link text-uppercase" href="#">
          <i class="fas fa-fw fa-user"  style="font-size: 20px;"></i>
          <span style="font-size: 20px;">Doctor</span></a>
      </li>

        <li class="nav-item active mt-3">
        <a class="nav-link" href="../../Clinicmanagement/pages/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

       <li class="nav-item mt-2">
        <a class="nav-link" href="../../Clinicmanagement/doctors/doctorsappoint.php">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Doctor Appointments</span></a>
      </li>
    
       <li class="nav-item">
        <a class="nav-link" href="../../Clinicmanagement/doctors/doctorstreat.php">
          <i class="fas fa-fw fa-prescription"></i>
          <span>Doctor Treatments</span></a>
      </li>

      <?php } ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

 
      <!-- Sidebar Toggler (Sidebar) -->
      

    </ul>
      <!-- End of Sidebar -->