<?php
    include '../php/middleware.php';
    include '../php/d_studentwise_trend.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CourseWise Trend | Faculty</title>
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
          <li class="active">
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
        <div class="row">
          <div class="col-6 pt-3 pb-1">
          <h4>Studentwise Trend</h4>
            <div class="viewport-header">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb has-arrow">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php">Faculty</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Studentwise Trend</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
        <div class="content-viewport">
          <div class="row d-flex justify-content-center mt-5">
            <div class="col-5">
              <div class="grid">
                <div class="grid-body">
                  <div class="item-wrapper">
                    <form method="GET">
                    <div class="row">
                      <div class="col">
                        <div class="form-group input-rounded">
                          <input type="number" class="form-control" placeholder="Student Id" spellcheck="false" data-ms-editor="true" name="id" required>
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
          <div class="row" <?php if(!isset($_GET['id'])){echo "hidden";} ?>>
              <div class="col-12">
                <h2 class="grid-title">Course Wise PLO comaparision</h2>
                <div class="row">
                  <div class="col-md-3">
                    <h5> Select one of the course(s) </h5>
                      <?php
                        foreach($scrss as $crs){
                          echo '<div><button class="btn btn-link" onclick="window.location.href = window.location.href + \'&crs='.$crs['course'].'\';" style="margin: 4px 0; width: 100%;">'.strtoupper($crs['course']).'</button></div>';
                        }
                      ?>
                  </div>
                  <div class="col-md-9">
                    <div class="grid">
                      <div class="grid-body">
                        <div class="item-wrapper">
                          <?php
                            if(isset($_GET['crs'])){
                              echo '<canvas id="crs-plo" height="100"></canvas>';
                            }else{
                              echo '<h5>No course selected</h5>';
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="grid">
                  <div class="grid-body">
                    <h2 class="grid-title">PLO comaparision with Program Average</h2>
                    <div class="item-wrapper">
                      <canvas id="prog-plo" height="100"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="grid">
                  <div class="grid-body">
                    <h2 class="grid-title">Course Wise PLO Achievement</h2>
                    <div class="item-wrapper">
                      <canvas id="course-plo" height="100"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="grid">
                  <div class="grid-body">
                    <h2 class="grid-title">Course Wise PLO Achivement Stat</h2>
                    <div class="item-wrapper">
                      <table class="table info-table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Course ID</th>
                            <th>Achieved PLO</th>
                            <th>Failed PLO</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            foreach($crss as $c => $d){
                              echo "<tr>
                                      <td>$i</td>
                                      <td>$c</td>
                                      <td>";
                              
                              foreach($d['plo']['ach'] as $p){
                                echo "PLO$p ";
                              }

                              echo "</td>
                                      <td>";

                              foreach($d['plo']['fld'] as $p){
                                echo "PLO$p ";
                              }

                              echo "</td>
                                    </tr>";
                              
                            }
                          ?>                          
                        </tbody>
                      </table>
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
            <small class="text-muted d-block">Copyright © 2019 <a href="http://www.uxcandy.co"
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
      var ctx = $('#prog-plo');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [
                <?php
                  foreach($opd as $plo){
                    echo "'PLO".$plo['plo']."', ";
                  }
                ?>
              ],
              datasets: [
                {
                  label: 'My data',
                  data: [
                    <?php
                      foreach($spd as $plo){
                        echo $plo['avg'].", ";
                      }
                    ?>
                  ],
                  backgroundColor: colors[0]
                },
                {
                  label: 'Program Average',
                  data: [
                    <?php
                      foreach($opd as $plo){
                        echo $plo['avg'].", ";
                      }
                    ?>
                  ],
                  backgroundColor: colors[1]
                }
            ]
          }
      });
      
      var ctx = $('#course-plo');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [
                <?php
                  foreach($crss as $crs => $d){
                    echo "'".strtoupper($crs)."', ";
                  }
                ?>
              ],
              datasets: [
              {
                  label: 'Achieved',
                  data: [
                    <?php
                      foreach($crss as $crs => $d){
                        echo $d['ach'].", ";
                      }
                    ?>
                  ],
                  backgroundColor: colors[0]
              },
              {
                  label: 'Failed',
                  data: [
                    <?php
                      foreach($crss as $crs => $d){
                        echo $d['atm'].", ";
                      }
                    ?>
                  ],
                  backgroundColor: colors[2]
              }
            ]
          },
          options: {
              scales: {
                yAxes: [{
                                ticks: {
                                    min: 0,
                                }
                            }]
              }
          }
      });
      
      var ctx = $('#crs-plo');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [
                <?php
                  foreach($scd as $plo){
                    echo "'PLO".$plo['plo']."', ";
                  }
                ?>
              ],
              datasets: [
                {
                  label: 'My data',
                  data: [
                    <?php
                      foreach($scd as $plo){
                        echo $plo['prcntg'].", ";
                      }
                    ?>
                  ],
                  backgroundColor: colors[0]
                },
                {
                  label: 'Course Average',
                  data: [
                    <?php
                      foreach($ocd as $plo){
                        echo $plo['avg'].", ";
                      }
                    ?>
                  ],
                  backgroundColor: colors[1]
                }
            ]
          }
      });

      function getCourse($crs){
        console.log($crs);
      }
    </script>
</body>

</html>