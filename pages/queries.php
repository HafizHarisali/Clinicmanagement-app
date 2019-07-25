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
    <div class="card shadow mb-4 showexpense">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
      <div class="table-responsive">
       <table class="table table-striped table-responsive" id="dataTable" width="100%" cellspacing="0">
          <thead style="background-color: #185479;color: white;">
            <tr>
              <th>Treatment Id</th>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Prescription</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Queries</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Treatment Id</th>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Prescription</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Queries</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            require('../../Clinicmanagement/controllers/queriescontroller.php');
            $queries=new queries;
            $query=$queries->showqueries();
            while ($row=$query->fetch()) { ?>
            <tr>
              <td><?php echo $row["Treatid"]?></td>
              <td><?php echo $row["PatientName"]?></td>
              <td><?php echo $row["DoctorName"];?></td>
              <td><?php echo $row["Prescription"]?></td>
              <td><?php echo $row["Startdate"]?></td>
              <td><?php echo $row["Enddate"]?></td>
              <td><?php echo $row["ask_query"]?></td>
              <td class="dropdown no-arrow">

              <a href="#" class="start_chat btn btn-primary"
                    data-treatid="<?php echo $row['Treatid'];?>"
                    data-patientname="<?php echo $row['PatientName'];?>"
                    data-patientid="<?php echo $row['Patientid'];?>"
                    >
                    Start Chat</a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        </div>
      <div id="user_model_details"></div>
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
  <div class="modal fade" id="querymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reply Query</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            <input type="hidden" name="id" class="qid">
                    <div class="form-row">
                     <textarea rows="10" class="form-control" placeholder="Type Your Reply" name="replyquery"></textarea>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                      <div class="form-group" style="margin-top: 30px;">
                      <button class="btn ripple-effect" name="btnreplyquery" style="color:white;background-color: #185479;">Ask</button>
                      </div>
                      </div>
                    </div>
                 </form>

               </div>

               <?php
              //   require('../../Clinicmanagement/controllers/queriescontroller.php');
              //   $queries=new queries;
              //   if(isset($_POST["btnreplyquery"]))
              //   {
              //   $queries->askquery($_POST["id"],$_POST["askquery"]);
              //   $message="Your Query Send Successfully";
                
              // }

             
               ?>
            <style type="text/css">
              
              .ui-dialog-titlebar{background-color:#185479;cursor: move;height: 40px;}
              .user_dialog{background-color: lightgrey;}
              .ui-button{margin-left: 160px;background-color: transparent;border:none;color: white;}
            </style>  

    </div>
  </div>
  </div>
   <script>
    function make_chat_dialog_box(to_treat_id, to_patient_name)
     {
      var modal_content = '<div id="user_dialog_'+to_treat_id+'" class="user_dialog" title="You have chat with '+to_treat_id+'">';
      modal_content += '<div style="height:340px; border:1px solid #ccc; overflow-y: auto; margin-bottom:24px; padding:16px;" class="chat_history" data-treatid="'+to_treat_id+'" id="chat_history_'+to_treat_id+'">';
      modal_content += '</div>';
      modal_content += '<div class="form-group">';
      modal_content += '<textarea name="ask_query'+to_treat_id+'" id="ask_query'+to_treat_id+'" class="form-control"></textarea>';
      modal_content += '</div><div class="form-group" align="right">';
      modal_content+= '<button type="button" name="send_chat" id="'+to_treat_id+'" class="btn btn-info send_chat">Send</button></div></div>';
      $('#user_model_details').html(modal_content);
     }

     $(document).on('click', '.start_chat', function(){
      var to_treat_id = $(this).data('treatid');
      var to_patient_name = $(this).data('patientname');
      make_chat_dialog_box(to_treat_id, to_patient_name);
      $("#user_dialog_"+to_treat_id).dialog({
       autoOpen:false,
       width:400
      });
      $('#user_dialog_'+to_treat_id).dialog('open');
     });


$(document).on('click', '.send_chat', function(){
  var to_treat_id = $(this).attr('id');
  var ask_query = $('#ask_query'+to_treat_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_treat_id:to_treat_id,ask_query:ask_query},
   success:function(data)
   {
    $('#ask_query'+to_treat_id).val('');
    $('#chat_history_'+to_treat_id).html(data);
   }
  })
 });
    </script>
 

