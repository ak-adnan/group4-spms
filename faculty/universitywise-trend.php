<?php
    include '../php/middleware.php';
    include '../php/d_universitywise_trend.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UniversityWise Trend | Dean</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.addons.css">
  <!-- endinject -->
  <!-- vendor css for this page -->
  <!-- End vendor css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/shared/style.css">
  <!-- endinject -->
  <!-- Layout style -->
  <link rel="stylesheet" href="../assets/css/demo_1/style.css">
  <!-- Layout style -->
  <link rel="shortcut icon" href="../assets/images/favicon.ico" />
</head>

<body class="header-fixed">
  <!-- partial:../../partials/_header.html -->
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
    <!-- partial:../../partials/_sidebar.html -->
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
              <span class="link-title">Sections</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
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
          <li class="active">
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
        <div class="row">
          <div class="col-6 pt-3 pb-1">
          <h4>Universitywise Trend</h4>
            <div class="viewport-header">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb has-arrow">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php">Dean</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Universitywise Trend</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
        <div class="content-viewport">
          <div class="row d-flex justify-content-center mt-5">
            <div class="col-10">
              <div class="grid">
                <div class="grid-body">
                  <div class="item-wrapper">
                    <form method="GET">
                    <div class="row">
                      <div class="col">
                        <div class="form-group input-rounded">
                          <input type="text" class="form-control" placeholder="University" spellcheck="false" data-ms-editor="true" name="uni" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group input-rounded">
                        <input type="text" class="form-control" placeholder="Program" spellcheck="false" data-ms-editor="true" name="prog" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group input-rounded">
                        <input type="text" class="form-control" placeholder="Semester" spellcheck="false" data-ms-editor="true" name="semester" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group input-rounded">
                        <input type="text" class="form-control" placeholder="PLO" spellcheck="false" data-ms-editor="true" name="plo" required>
                        </div>
                      </div>
                    </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" <?php if(!isset($_GET['semester'])){echo "hidden";} ?>>
            <div class="col-md-12">
              <div class="grid">
                <div class="grid-body">
                  <h2 class="grid-title">Achieved Count Comparison</h2>
                  <div class="item-wrapper">
                    <canvas id="acc-comparision" width="400" height="200"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="grid">
                <div class="grid-body holder">
                  <h2 class="grid-title">Graduates Percentage Comparision</h2>
                  <div class="item-wrapper">
                    <canvas id="grd-comparision" width="400" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="grid">
                <div class="grid-body">
                  <h2 class="grid-title">PLO Achievement Percentage</h2>
                  <div class="item-wrapper">
                    <canvas id="plo-comparision" width="400" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content viewport ends -->
      <!-- partial:../../partials/_footer.html -->
      <footer class="footer">
        <div class="row">
          <div class="col-sm-6 text-center text-sm-right order-sm-1">
            <ul class="text-gray">
              <li><a href="#">Terms of use</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>
          <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
            <small class="text-muted d-block">Copyright ?? 2019 <a href="http://www.uxcandy.co"
                target="_blank">UXCANDY</a>. All rights reserved</small>
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
  <script src="../assets/vendors/js/vendor.addons.js"></script>
  <script src="../assets/vendors/jquery/jquery-3.6.0.min.js"></script>
  <!-- endinject -->
  <!-- Vendor Js For This Page Ends-->
  <script src="../assets/vendors/chartjs/Chart.min.js"></script>
  <script src="../assets/js/coolors.js"></script>
  <!-- Vendor Js For This Page Ends-->

  <script>
    var ctx = $('#acc-comparision');
    var myChart = new Chart(ctx, {
      type: 'radar',
      data: {
          labels: [
            <?php
              foreach($accd as $acc){
                echo "'PLO".$acc['plo']."',";
              }
            ?>
          ],
          datasets: [
            {
              label: 'Achieved',
              data: [
                <?php
                  foreach($accd as $acc){
                    echo $acc['ach'].",";
                  }
                ?>
              ],
              backgroundColor: 'rgba(6,214,160, 0.5)',
              borderColor: colors[1]
              
          },
          {
              label: 'Attempted',
              data: [
                <?php
                  foreach($accd as $acc){
                    echo $acc['atm'].",";
                  }
                ?>
              ],
              backgroundColor: 'rgba(239,71,111, 0.5)',
              borderColor: colors[2]
          }
        ]
      },
      options: {
        
      } 
    });

    var ctx = $('#grd-comparision');
    var myChart = new Chart(ctx, {
      type: 'radar',
      data: {
          labels: [
            <?php
              foreach($grdd as $grd){
                echo "'".$grd['program']."',";
              }
            ?>
          ],
          datasets: [
            {
              label: 'Graduates ',
              data: [
                <?php
                  foreach($grdd as $grd){
                    echo $grd['prcntg'].",";
                  }
                ?>
              ],
              backgroundColor: 'rgba(6,214,160, 0.5)',
              borderColor: colors[1]
              
          }
        ]
      },
      options: {
        
      } 
    });

    var ctx = $('#plo-comparision');
    var myChart = new Chart(ctx, {
      type: 'radar',
      data: {
          labels: [
            <?php
              foreach($plod as $plo){
                echo "'PLO".$plo['plo']."',";
              }
            ?>
          ],
          datasets: [
            {
              label: 'Graduates ',
              data: [
                <?php
                  foreach($plod as $plo){
                    echo $plo['prcntg'].",";
                  }
                ?>
              ],
              backgroundColor: 'rgba(6,214,160, 0.5)',
              borderColor: colors[1]
              
          }
        ]
      },
      options: {
        
      } 
    });
  
</script>
</body>

</html>