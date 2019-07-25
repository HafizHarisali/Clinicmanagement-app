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
      <h6 class="m-0 font-weight-bold" style="color: #185479;">Your Treatments</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead style="background-color: #185479;color: white;">
            <tr>
              <th>Id</th>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Prescription</th>
              <th>Cost</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Prescription</th>
              <th>Cost</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            require('../../Clinicmanagement/controllers/treatmentscontroller.php');
            $treatments=new treatments;
            $today = date("Y-m-d"); 
            $check=$treatments->getdoctortreat();
            while ($row=$check->fetch()) { 
              
              ?>
            <tr>
              <td><?php echo $row["Id"];?></td>
              <td><?php echo $row["Patientname"];?></td>
              <td><?php echo $row["Doctorname"]?></td>
              <td><?php echo $row["Prescription"]?></td>
              <td><?php echo $row["Cost"]?></td>
              <td><?php echo $row["Startdate"]?></td>
              <td><?php echo $row["Enddate"]?></td>
              <td class="dropdown no-arrow">
                <?php if($today < $row["Enddate"]){?>
              <a href="#" class="start_chat btn btn-primary"
                    data-treatid="<?php echo $row['Id'];?>"
                    data-patientname="<?php echo $row['Patientname'];?>"
                    data-patientid="<?php echo $row['Patientid'];?>"
                    >
                    Start Chat</a>
                  <?php }?>
              </td>
            </tr>
          <?php }  ?>
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <div class="modal fade" id="querymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ask Query</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            <input type="hidden" name="id" class="qid">
                    <div class="form-row">
                     <textarea rows="10" class="form-control" placeholder="Type Your Query" name="askquery"></textarea>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                      <div class="form-group" style="margin-top: 30px;">
                      <button class="btn ripple-effect" name="btnquery" style="color:white;background-color: #185479;">Ask</button>
                      </div>
                      </div>
                    </div>
                 </form>

               </div>

                 <style type="text/css">
              
              .ui-dialog-titlebar{background-color:#185479;cursor: move;height: 25px; color: white;border-radius: 0px 0px 0px 0px;}
              .user_dialog{background-color: #185479;}
              .ui-button{margin-left: 70px;background-color: transparent;border:none;color: white;}
            </style>  
    </div>
  </div>
  </div>
    <script>
      $(document).ready(function(){

        setInterval(function(){
        update_chat_history_data();
       }, 2000);

    


    function make_chat_dialog_box(to_treat_id, to_patient_name)
     {
      var modal_content = '<div id="user_dialog_'+to_treat_id+'" class="user_dialog" title="You have chat  against treatment Id '+to_treat_id+'">';
      modal_content += '<div style="height:340px; border:1px solid #185479;background-color:white; overflow-y: auto; padding:16px;" class="chat_history" data-treatid="'+to_treat_id+'" id="chat_history_'+to_treat_id+'">';
      modal_content += fetch_user_chat_history(to_treat_id);
      modal_content += '</div>';
      modal_content += '<div class="form-group">';
      modal_content += '<textarea name="ask_query'+to_treat_id+'" id="ask_query'+to_treat_id+'" class="form-control" style="border-radius:0" Placeholder="Please type your message"></textarea>';
      modal_content += '</div><div class="form-group" align="right">';
      modal_content+= '<button type="button" name="send_chat" id="'+to_treat_id+'" class="btn btn-info btn-block send_chat" style="border-radius:0px;margin-top:-15px;background-color:#185479;">Send</button></div></div>';
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
   url:"../pages/insert_chat.php",
   method:"POST",
   data:{to_treat_id:to_treat_id,ask_query:ask_query},
   success:function(data)
   {
    $('#ask_query'+to_treat_id).val('');
    $('#chat_history_'+to_treat_id).html(data);
   }
  })
 });

function fetch_user_chat_history(to_treat_id)
 {
  $.ajax({
   url:"../pages/fetch_user_chat_history.php",
   method:"POST",
   data:{to_treat_id:to_treat_id},
   success:function(data){
    $('#chat_history_'+to_treat_id).html(data);
   }
  });
 }

 function update_chat_history_data()
 {
  $('.chat_history').each(function(){
   var to_treat_id = $(this).data('treatid');
   fetch_user_chat_history(to_treat_id);
  });
 }

   });


    </script>
 
 