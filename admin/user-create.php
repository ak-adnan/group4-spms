<?php
  include '../php/middleware.php';
  include '../php/user.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create User | Admin</title>
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
          <li class="active">
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
          <li>
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
              <div class="col-12 py-5">
                <h4>Add User</h4>
                <div class="viewport-header">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb has-arrow">
                      <li class="breadcrumb-item">
                        <a href="dashboard.php">Admin</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="users-list.php">Users</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Create User</li>                      
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="grid">
                <div class="grid-body">
                  <div class="item-wrapper">
                    <div class="row mb-3">
                      <div class="col-md-8 mx-auto">
                        <form method="POST">
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label>Role</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <select class="custom-select" name="user" onchange="roleChanger();">
                                <option value="student" selected>Student</option>
                                <option value="faculty">Faculty</option>
                                <option value="admin">Admin</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="id">User Id</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="text" class="form-control" id="id" name="id" placeholder="Enter User Id">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="f_name">First Name</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="l_name">Last Name</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                              <label for="email">Email</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area" id="program-select">
                            <div class="col-md-3 showcase_text_area">
                              <label>Program</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <select class="custom-select" name="program">
                                <?php
                                  foreach($programs as $program){
                                    echo "<option value='".$program['id']."'>".$program['name']." in ".$program['department']."</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row showcase_row_area" id="department-select" hidden>
                            <div class="col-md-3 showcase_text_area">
                              <label>Department</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                              <select class="custom-select" name="department">
                                <?php
                                  foreach($departments as $department){
                                    echo "<option value='".$department['id']."'>".$department['name']."</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                      </div>
                    </div>
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
      $(document).ready(function() {
          $('#user-table').DataTable();
      } );

      function roleChanger(){
        $user = $("select[name=user]").val();
        if($user == 'student'){
          $("#program-select").removeAttr('hidden');
          $("#department-select").attr('hidden', 'true');
        }else if($user =='faculty'){
          $("#department-select").removeAttr('hidden');
          $("#program-select").attr('hidden', 'true');
        }else{
          $("#department-select").attr('hidden', 'true');
          $("#program-select").attr('hidden', 'true');
        }
      }

    </script>
  </body>
</html>