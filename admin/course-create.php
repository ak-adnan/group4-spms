<?php
  include '../php/middleware.php';
  include '../php/course.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Course | Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.addons.css">
    <!-- endinject -->
    <!-- vendor css for this page -->
    <link rel="stylesheet" href="../assets/vendors/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="../assets/vendors/tagify/tagify.css">
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout style -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">

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
            <a href="users-list.php">
              <span class="link-title">Users</span>
              <i class="mdi mdi-account-multiple link-icon"></i>
            </a>
          </li>
          <li>
            <a href="schools-list.php">
              <span class="link-title">Schools</span>
              <i class="mdi mdi-animation link-icon"></i>
            </a>
          </li>
          <li>
            <a href="departments-list.php">
              <span class="link-title">Departments</span>
              <i class="mdi mdi-archive link-icon"></i>
            </a>
          </li>
          <li>
            <a href="programs-list.php">
              <span class="link-title">Programs</span>
              <i class="mdi mdi-clipboard-outline link-icon"></i>
            </a>
          </li>
          <li class="active">
            <a href="courses-list.php">
              <span class="link-title">Courses</span>
              <i class="mdi mdi-library-books link-icon"></i>
            </a>
          </li>
          <li>
            <a href="sections-list.php">
              <span class="link-title">Sections</span>
              <i class="mdi mdi-code-equal link-icon"></i>
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
              <div class="col-9 py-5">
                <h4>Create Course</h4>
                <div class="viewport-header">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb has-arrow">
                      <li class="breadcrumb-item">
                        <a href="dashboard.php">Admin</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="courses-list.php">Courses</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Create Course</li>                      
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="grid">
                <div class="grid-body">
                  <div class="item-wrapper">
                    <form method="POST">
                      <div class="row mb-3" id="part-1">
                        <div class="col-md-8 mx-auto">
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label>Program Title</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <select class="custom-select" name="program">
                                <?php
                                  foreach($programs as $program){
                                    echo "<option value='".$program['id']."' selected>".$program['name']." in ".$program['department']."</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="id">Course Id</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="text" class="form-control" id="id" name="id" placeholder="Enter Course Id">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="name">Course Title</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Course Title">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="level">Course Level</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="number" class="form-control" id="level" name="level" placeholder="Enter Level of Course">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="credits">Credits</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="number" class="form-control" id="credits" name="credits" placeholder="Enter Credits">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="total_co">Total CO</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="number" class="form-control" id="total_co" name="total_co" placeholder="Total CO">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3" id="part-2" hidden>
                        <div class="col-md-12 mx-auto" id="co-box">
                          <div class="form-group row showcase_row_area">
                            <table class="table info-table table-bordered">
                              <thead>
                                <tr id="view-header">
                                  <th>PLO</th>
                                </tr>
                              </thead>
                              <tbody id="view-body">
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6 text-left">
                          <button type="button" class="btn btn-info" id="back-btn" hidden>Back</button>
                        </div>
                        <div class="col-6 text-right">
                          <button type="button" class="btn btn-primary" id="next-btn">Next</button>
                          <button type="submit" class="btn btn-success" id="sub-btn" hidden>Submit</button>
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
              <small class="text-muted d-block">Copyright © 2021 <a href="#">G4</a>. All rights reserved</small>
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
    <script src="../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../assets/js/charts/chartjs.addon.js"></script>
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
      $plo = 13;

      $('#next-btn').click(function(){
        $('#back-btn').removeAttr('hidden');
        $('#part-'+$part).attr('hidden', true);
        $part++;
        $('#part-'+$part).removeAttr('hidden');
        if($part==2){
          $total_co = $("#total_co").val();
          addCoInput();
          $('#next-btn').attr('hidden', true);
          $('#sub-btn').removeAttr('hidden');
        }
        
      });
      $('#back-btn').click(function(){
        $('#sub-btn').attr('hidden', true);
        $('#next-btn').removeAttr('hidden');
        $('#part-'+$part).attr('hidden', true);
        $part--;
        $('#part-'+$part).removeAttr('hidden');
        if($part==1){
          $('#back-btn').attr('hidden', true);
        }
      });


      function addCoInput(){
        $total_co = $("#total_co").val();
        for($co=1; $co<=$total_co; $co++){
          $("#view-header").append(`<th>CO`+$co+`</th>`);        
          for($i =1; $i<=$plo; $i++){
            $("#mapper-"+$i).append(`<td><input type="checkbox" class="form-check-input" name="plo-`+$i+`[]" id="co-`+$i+`-`+$co+`" value="`+$co+`"></td>`);
          } 
        }
      };

      $( document ).ready(function() {
        for($i=1; $i<=$plo; $i++){
          $("#view-body").append(`<tr id="mapper-`+$i+`">
                                  <td>PLO`+$i+`</td>
                                </tr>`);
        }  
      });

    </script>
  </body>
</html>