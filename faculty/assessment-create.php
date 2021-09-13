<?php
  include '../php/middleware.php';
  include '../php/f_assessment-create.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Assessment | Faculty</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.addons.css">
    <!-- endinject -->
    <!-- vendor css for this page -->
    <link rel="stylesheet" href="../assets/vendors/datatables/jquery.dataTables.css">
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout style -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <!-- Layout style -->
    <!-- <link rel="shortcut icon" href="asssets/images/favicon.ico" /> -->
  </head>
  <body class="header-fixed">
    <!-- partial:partials/_header.html -->
    <nav class="t-header">
      <div class="t-header-brand-wrapper">
        <a href="index.html">
          <img class="logo" src="../assets/images/logo.png" alt="">
          <img class="logo-mini" src="../assets/images/logo_mini.png" alt="">
        </a>
      </div>
      <div class="t-header-content-wrapper">
        <div class="t-header-content">
          <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
            <i class="mdi mdi-menu"></i>
          </button>
        </div>
      </div>
    </nav>
    <!-- partial -->
    <div class="page-body">
      <!-- partial:partials/_sidebar.html -->
      <div class="sidebar">
        <div class="user-profile">
          <div class="display-avatar animated-avatar">
            <img class="profile-img img-lg rounded-circle" src="../assets/images/profile/male/image_1.png" alt="profile image">
          </div>
          <div class="info-wrapper">
            <h4 class="user-name"><?php echo $_SESSION["name"]; ?></h4>
          </div>
        </div>
        <ul class="navigation-menu">
          <li class="nav-category-divider">MAIN</li>
          <li>
            <a href="dashboard.php">
              <span class="link-title">Dashboard</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
            <a href="sections-list.php">
              <span class="link-title">Section</span>
              <i class="mdi mdi-book-open-variant link-icon"></i>
            </a>
          </li>
          <li class="active">
            <a href="assessments-list.php">
              <span class="link-title">Assessments</span>
              <i class="mdi mdi-clipboard link-icon"></i>
            </a>
          </li>
          <li>
            <a href="studentwise-trend.php">
              <span class="link-title">Studentwise Trend</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
            <a href="coursewise-trend.php">
              <span class="link-title">Coursewise Trend</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
            <a href="programwise-trend.php">
              <span class="link-title">Programwise Trend</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
            <a href="universitywise-trend.php">
              <span class="link-title">Universitywise Trend</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
        </li>
          <li>
            <a href="../php/login.php?logout=1">
              <span class="link-title">Logout</span>
              <i class="mdi mdi-logout link-icon"></i>
            </a>
          </li>
        </ul>
      </div>
      <!-- partial -->
      <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">
            <div class="row">
              <div class="col-12 py-5">
                <h4>Create Assessment</h4>
                <div class="viewport-header">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb has-arrow">
                      <li class="breadcrumb-item">
                        <a href="dashboard.php">Faculty</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="assessments-list.php">Assessments</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Create Assessment</li>                      
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="grid">
                <div class="grid-body">
                  <div class="item-wrapper">
                    <form enctype='multipart/form-data' id="asev-form" method="POST">
                      <div class="row mb-3" id="part1">
                        <div class="col-md-8 mx-auto">

                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label>Section</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <select class="custom-select" name="section_id">
                                <?php
                                  foreach($sctns as $sctn){
                                    echo "<option value='".$sctn['id']."'>".$sctn['num']." - ".strtoupper($sctn['course_id'])." - ".$sctn['semester']."</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label>Assessment Type</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <select class="custom-select" name="type">
                                <option value="mid">Mid</option>
                                <option value="final">Final</option>
                                <option value="lab">Lab</option>
                                <option value="project">Project</option>
                                <option value="tutorial">Tutorial</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="total_q">Total Question</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="text" class="form-control" id="total_q" name="total_q" placeholder="Enter Number of Total Question">
                            </div>
                          </div>
                          <!-- <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                              <label>File Upload<span style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <p class="text-muted mt-2">
                                  <small><span style="color: red;">*</span>Instructor must upload a specificicaly formatted csv file.</small>
                                </p>
                              </div>
                            </div>
                          </div> -->
                        </div>
                      </div>

                      <div class="row mb-3" id="part2" hidden>
                        <div class="col-md-10 mx-auto">
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area">
                              <label for="mark1">Mark in Question 1</label>
                            </div>
                            <div class="col-md-4 showcase_content_area">
                              <input type="text" class="form-control" id="mark1" name="mark1" placeholder="Enter Question1 Mark">
                            </div>
                            <div class="col-md-2 showcase_text_area">
                              <label for="co1">CO in Question 1</label>
                            </div>
                            <div class="col-md-4 showcase_content_area">
                              <input type="text" class="form-control" id="co1" name="co1" placeholder="Assigned CO in Question1">
                            </div>
                          </div>
                          <div class="row showcase_row_area mb-4">
                            <div class="col-md-3 showcase_text_area">
                              <label>File Upload<span style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="qc1" name="qc1">
                                <label class="custom-file-label" for="qc1">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3" id="part3" hidden>
                        <div class="col-md-8 mx-auto">
                          <div class="form-group row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                              <label>File Upload<span style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="evaluation">
                                <label class="custom-file-label" for="customFile">Choose Evaluation File</label>
                                <p class="text-muted mt-2">
                                  <small><span style="color: red;">*</span>Instructor must upload a specificicaly formatted csv file.</small>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6 text-left">
                          <button type="button" class="btn btn-secondary" id="bck-btn" onclick="goBack();" hidden>Back</button>
                        </div>
                        <div class="col-6 text-right">
                          <button type="button" class="btn btn-primary" id="nxt-btn" onclick="goNext();">Next</button>
                        </div>
                      </div>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content viewport ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="row">
            <div class="col-sm-6 text-center text-sm-right order-sm-1">
              <ul class="text-gray">
                <li><a href="#">Terms of use</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>
            <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
              <small class="text-muted d-block">Copyright © 2021 <a href="#" >G4</a>. All rights reserved</small>
              <small class="text-gray mt-2">Handcrafted With <i class="mdi mdi-heart text-danger"></i></small>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- page content ends -->
    </div>
    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/core.js"></script>
    <!-- endinject -->
    <!-- Vendor Js For This Page Ends-->
    <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendors/js/vendor.addons.js"></script>
    <script src="../assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/vendors/datatables/jquery.dataTables.js"></script>
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <!-- endbuild -->
    <script>
      $part = 1;
      $set=0;

      function goNext(){
        if($part==3){
          $("#asev-form").submit();
        }else{
          $part++;
          if($part==2){
            $("#bck-btn").removeAttr('hidden');
            $("#part1").attr('hidden', 'true');
            if($set==0){
              genAsmnt();
            }
            $("#part2").removeAttr('hidden');
          }else{
            $("#nxt-btn").html("Submit");
            $("#part2").attr('hidden', 'true');
            $("#part3").removeAttr('hidden');
          }
        }
      }

      function goBack(){
        $part--;
        if($part==1){
          $("#bck-btn").attr('hidden', 'true');
          $("#part2").attr('hidden', 'true');
          $("#part1").removeAttr('hidden')
        }else if($part==2){
          $("#nxt-btn").html("Next");
          $("#part3").attr('hidden', 'true');
          $("#part2").removeAttr('hidden');
        }
      }

      function genAsmnt(){
        $set = 1;
        $("#part2").empty();
        $total_q = $("#total_q").val();
        console.log($total_q);
        for($i=1; $i<=$total_q; $i++){
          $("#part2").append(`
                        <div class="col-md-10 mx-auto">
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area">
                              <label for="mark`+$i+`">Mark in Question `+$i+`</label>
                            </div>
                            <div class="col-md-4 showcase_content_area">
                              <input type="text" class="form-control" id="mark`+$i+`" name="mark`+$i+`" placeholder="Enter Question`+$i+` Mark">
                            </div>
                            <div class="col-md-2 showcase_text_area">
                              <label for="co`+$i+`">CO in Question `+$i+`</label>
                            </div>
                            <div class="col-md-4 showcase_content_area">
                              <input type="text" class="form-control" id="co`+$i+`" name="co`+$i+`" placeholder="Assigned CO in Question`+$i+`">
                            </div>
                          </div>
                          <div class="row showcase_row_area mb-4">
                            <div class="col-md-3 showcase_text_area">
                              <label>Upload Question Content<span style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="qc`+$i+`" name="qc`+$i+`">
                                <label class="custom-file-label" for="qc`+$i+`">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
          `);
        }
      }

      $("#total_q").change(function(){
        $set=0;
      });


    </script>
  </body>
</html>