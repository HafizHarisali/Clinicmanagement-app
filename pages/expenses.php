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
        #expensesform label.error {
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
             width: 437px; 
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
                      <a href="#" class="btn btn-sm shadow-sm btnaddexpense" style="background-color: #185479;color: white;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Expense</a>
                      <a href="#" class="btn btn-sm shadow-sm btnshowexpense" style="background-color: #185479;color: white;display: none;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Show Expenses</a>
                  </div>
                  <div class="row">
                      <div class="col-xl-2"></div>
                      <div class="col-xl-8 col-lg-7 addexpense" style="display: none;">
                          <div class="card shadow mb-4">
                              <!-- Card Header -->
                              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h6 class="m-0 font-weight-bold cardheading">Add Expenses</h6>
                                  <div class="dropdown no-arrow">
                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                      </a>
                                  </div>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                  <form method="post" id="expensesform">
                                      <div class="row">
                                          <div class="col-md-2"></div>
                                          <div class="col-md-8">
                                              <label>Item Name</label>
                                              <input type="text" name="name" class="form-control">

                                              <label class="mt-3">Amount</label>
                                              <input type="number" name="cost" class="form-control">

                                              <button class="btn btn-block mt-3" name="btnaddexpense">Add Expense</button>
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
                                  <?php
           require('../../Clinicmanagement/controllers/expensescontroller.php');
            $expenses=new expenses;
           if(isset($_POST["btnaddexpense"]))
           {
            $expenses->addexpenses($_POST["name"],$_POST["cost"]);
            echo "<script>swal('Added Successfully!','success');</script>";
           }

           ?>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3"> </div>
                  </div>

                  <form method="post">
                      <div class="card shadow mb-4 showexpense">
                          <div class="card-header py-3">
                              <div class="row">
                                  <div class="col-md-3">
                                      <h6 class="m-0 font-weight-bold" style="color: #185479;">Expenses</h6>

                                  </div>
                                  <div class="col-md-4"></div>
                                  <div class="col-md-4">
                                      <input type="month" name="month" class="form-control">
                                  </div>
                                  <div class="col-md-1">
                                      <input type="submit" name="btngetmonth" class="btn" style="background-color: #185479;color:white;" value="Get">
                                  </div>
                              </div>

                          </div>
                          <div class="card-body">

                              <div class="table-responsive">
                                  <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                      <thead style="background-color: #185479;color: white;">
                                          <tr>
                                              <th>Item Name</th>
                                              <th>Cost</th>
                                              <th>Date Time</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                              <th>Item Name</th>
                                              <th>Cost</th>
                                              <th>Date Time</th>
                                              <th>Actions</th>
                                          </tr>
                                      </tfoot>
                                      <tbody>
                                          <?php
      $select=$expenses->getexpenses();
      $cost=0;
      while ($row=$select->fetch()) { ?>
                                              <tr>
                                                  <td>
                                                      <?php echo $row["Name"]?>
                                                  </td>
                                                  <td>
                                                      <?php echo $row["Cost"];
          $cost+=$row["Cost"];
          ?>
                                                  </td>
                                                  <td>
                                                      <?php echo $row["Datetime"]?>
                                                  </td>
                                                  <td class="dropdown no-arrow">
                                                      <a class="dropdown-toggle ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fas fa-ellipsis-h fa-sm fa-fw" style="font-size: 18px;color:#185479;"></i>
                                                      </a>
                                                      <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                          <a href="#" class="dropdown-item edit_btn1" data-toggle="modal" data-target="#logoutModal" data-name="<?php echo $row['Name'];?>" data-cost="<?php echo $row['Cost'];?>" data-datetime="<?php echo $row['Datetime'];?>" data-id="<?php echo $row['Id'];?>">
              Edit</a>
                                                          <a class="dropdown-item" href="<?php echo 'expenses.php?action=delete&id='.$row['Id'] ?>">Delete</a>
                                                      </div>
                                                  </td>
                                              </tr>
                                              <?php } ?>
                                      </tbody>
                                  </table>

                              </div>
                  </form>
                  <button style="margin-left: 0px;background-color:#185479;color: white;border-radius: 0px;" class="btn">Total Expenses =
                      <?php echo $cost?>
                  </button>
                  </div>
                  </div>
              </div>
              <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php
if(isset($_GET['action']))
{
  if($_GET['action']=='delete')
  {
    $id=$_GET['id'];
    $expenses->deleteexpenses();
    header('location:expenses.php');
  }
}
?>
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
                    <div class="modal-body">
                        <form method="post" id="expenseseditform">
                            <div class="form-row">
                                <input type="hidden" name="id" class="eid">
                                <label><span>Item Name</span></label>
                                <input type="text" name="name" placeholder=" " required="" class="form-control ename" />
                            </div>
                            <div class="form-row">
                                <label><span>Cost</span></label>
                                <input type="number" name="cost" placeholder=" " required="" class="form-control ecost" />
                            </div>
                            <!-- <div class="form-row">
                    <label class="pure-material-textfield-outlined">
                      <input type="date" name="datetime" placeholder=" " required="" style="width: 676px;" />
                    <span style="width: 676px;">Date</span>
                    </label>
                    </div> -->

                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-top: 30px;">
                                        <button class="btn ripple-effect" name="btneditexpense" style="color:white;background-color: #185479;">Update Expense</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php

                 if(isset($_POST['btneditexpense']))
                    {
                    $expenses->updateexpenses($_POST['id'],$_POST['name'],$_POST['cost']);
                    header('location:expenses.php');
                    }

                 ?>
                    </div>
                    <script>
                        $(document).on("click", '.edit_btn1', function(e) {
                            var name = $(this).data('name');
                            var id = $(this).data('id');
                            var cost = $(this).data('cost');

                            $(".eid").val(id);
                            $(".ename").val(name);
                            $(".ecost").val(cost);
                        });
                    </script>
                    
                    <script>
                      $(document).ready(function () {

                      $('#expensesform').validate({ // initialize the plugin
                          rules: {
                              name: {
                                  required: true,
                                  lettersOnly:true,
                                  minLength:2
                              },
                              cost: {
                                  required: true,
                                  numbersOnly:true
                              }
                          }
                      });


                       $('#expenseseditform').validate({ // initialize the plugin
                          rules: {
                              name: {
                                  required: true,
                                  lettersOnly:true,
                                  minLength:2
                              },
                              cost: {
                                  required: true,
                                  numbersOnly:true
                              }
                          }
                      });
                  });
                    </script>
                </div>
            </div>