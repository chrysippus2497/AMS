<?php require_once('../Functions.php'); ?>
<?php
    if (!is_user_logged_in())
        header('Location: ../login.php');   
?>
<?php require_once('./update_password.php')?>
<?php require_once('./header.php')?>
<?php require_once('./delete_account.php')?>
<?php  
         
         $delete_account ="";
         if(isset($_GET["delete"]))
              {
                if($_GET["delete"] == "error")
                {
                  $delete_account = '<div class="alert alert-danger" style="animation: fadeOut 2s forwards;
    animation-delay: 5s;">Password required.</div>';
                }
                 elseif($_GET["delete"] == "wrongpwd")
                {
                  $delete_account = '<div class="alert alert-danger" style="animation: fadeOut 2s forwards;
    animation-delay: 5s;">Wrong password.</div>';
                }


              }
      ?>

      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./user.php">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./students.php">
              <i class="material-icons">groups</i>
              <p>Students</p>
            </a>
          </li>
          <li class="nav-item ">
          <a class="nav-link" href="./sections.php">
            <i class="material-icons">sensor_door</i>
            <p>Sections</p>
          </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./courses.php">
              <i class="material-icons">school</i>
              <p>Courses</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./attendance.php">
              <i class="material-icons">content_paste</i>
              <p>Attendance</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./reports.php">
              <i class="material-icons">library_books</i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./chart.php">
              <i class="material-icons">analytics</i>
              <p>Chart</p>
            </a>
          </li>
          <li class="nav-item active active">
            <a class="nav-link" href="./settings.php">
              <i class="material-icons">settings</i>
              <p>Settings</p>
            </a>
          </li>

         <!--  <li class="nav-item ">
            <a class="nav-link" href="./icons.php">
              <i class="material-icons">bubble_chart</i>
              <p>Icons</p>
            </a>
          </li> -->
          <!-- <li class="nav-item ">
            <a class="nav-link" href="./map.php">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </a>
          </li> -->
          <li class="nav-item ">
            <a class="nav-link" href="../logout.php">
              <i class="material-icons">logout</i>
              <p>Logout</p>
            </a>
          </li>
<!--           <li class="nav-item ">
            <a class="nav-link" href="./rtl.php">
              <i class="material-icons">language</i>
              <p>RTL Support</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;"><h2>Settings</h2></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
         <?php require_once('./navbar.php')?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php echo $delete_account?>
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Change Password</h4>
                </div>
                <?php 
                 if(isset($_GET["change_password"]))
                      {
                        if($_GET["change_password"] == "true")
                        {
                          echo  '<script> alert("Change password success."); </script>';
                        }
                        elseif ($_GET["change_password"] == "false") {
                           echo  '<script> alert("Change password failed."); </script>';
                         } 
                      }
                  ?>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <form method="post">
                      <div class="form-group">
                      <label>Old Password</label>
                      <input 
                          class="form-control form-control <?php echo $invalid_old_password; ?>" 
                          type="password"
                          value="<?php echo $old_password; ?>" 
                          name="old_password" >
                          <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                Please enter your old password.
                            </div>
                            <br>
                        <?php endif; ?>

                         <!-- Validation error form backend -->
                        <?php if ($invalid_credentials): ?>
                        <p class="text-danger">
                            <small>Old password is incorrect.</small>
                        </p>
                    <?php endif; ?>
                      </div>

                      <div class="form-group">
                      <label>New Password</label>
                      <input 
                          class="form-control form-control <?php echo $invalid_new_password; ?>" 
                          type="password" 
                          value="<?php echo $new_password; ?>"
                          name="new_password">

                          <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                Please enter a new password.
                            </div>
                            <br>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                      <label>Re-type New Password</label>
                      <input 
                          class="form-control form-control <?php echo $invalid_retype_new_password; ?>" 
                          type="password" 
                          value="<?php echo $retype_new_password; ?>"
                          name="retype_new_password">
                          <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                New password did not match.
                            </div>
                            <br>
                        <?php endif; ?>
                      </div>
                      <button type="submit" class="btn btn-primary pull-right" >Change</button>
                    </form>                    
                  </div>
                </div>
              </div>

             <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash"></i>
                 Delete My Account
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="POST">
                     <div class="modal-body">
                     <input type="hidden" name="delete_id" id="delete_id">
                     <center> 
                     <h4>Are you sure?</h4>

                     <p ><b>This is permanent.</b><br>
                     When you delete your AMS account, you won't be able to retrieve the content or information you've created on AMS.
                    </p>
                     <input class="form-control form-control" type="password" name="delete_account_password" style="text-align: center;" required>Enter Password
                     </center>
                     </div>
                     <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                      <button type="submit" name="delete_account_btn" class="btn btn-danger">Yes</button>
                     </div>
                     </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-12">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Attendance Chart</h4>
                </div>
              
              </div>
            </div> -->
          </div>
        </div>

      </div>

        <footer>
            <br><br>
            <center>
            <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by 
             <a href="#">PD Crisostomo</a>.
            </p>
          </div>
          </center>
          </footer>
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>