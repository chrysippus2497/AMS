<?php require_once('../functions.php'); ?>
<?php
	 if (!is_user_logged_in())
		  header('Location: ../login.php');   
?>
<?php require_once('./add_student.php');?>
<?php require_once('./edit_student.php')?>
<?php require_once('./delete_student.php')?>
<?php require_once('./header.php')?>
  <?php 
			if(isset($_GET["registered"]))
				  {
					 if($_GET["registered"] == "true")
					 {
						echo  '<script> alert("Successfully added."); </script>';
					 }
					 elseif ($_GET["registered"] == "false") {
						 echo  '<script> alert("There was an error adding the student."); </script>';
					  } 
				  }
		?>

	  <?php 
			if(isset($_GET["delete"]))
				  {
					 if($_GET["delete"] == "success")
					 {
						echo  '<script> alert("Deleted."); </script>';
					 }
					 elseif ($_GET["delete"] == "error") {
						 echo  '<script> alert("There was an error deleting the selected data."); </script>';
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
			 <li class="nav-item active">
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
			 <li class="nav-item  ">
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
				<a class="navbar-brand" href="javascript:;"><h2>Students</h2></a>
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
				  <div class="card">
					 <div class="card-header card-header-primary">
						<h4 class="card-title ">Student Lists</h4>
					 </div>
					 <div class="card-body">
						<div class="table-responsive">
							 <table id="datatableid"class="table table-bordered table-light table-sm">
								<?php 
 									 $uid = $_SESSION['id'];
								  	 $connection = mysqli_connect("localhost", "root", "", "attendance-monitoring-system");
									 $query = "SELECT * FROM students WHERE uid = '$uid'";
									 $query_run = mysqli_query($connection, $query);
							 ?>
								<thead>
								  <tr>
									 <th hidden>Student ID</th>
									 <th>Firstname</th>
									 <th>Lastname</th>
									 <th>Course</th>
									 <th>Section</th>
									 <th>Year Level</th>
									 <th>Action</th>


								  </tr>
								</thead>
								<tbody>
								  <?php 

								  if(mysqli_num_rows($query_run) > 0)
								  {
									 while($row = mysqli_fetch_assoc($query_run))
									 {
										?>

											
								  <tr>   
											 <td hidden><?php echo $row['id']?></td>
											 <td style="text-transform: capitalize;"><?php echo $row['firstname']?></td>
											 <td style="text-transform: capitalize;"><?php echo $row['lastname']?></td>
											 <td><?php echo $row['course']?></td>
											 <td><?php echo $row['section']?></td>
											 <td><?php echo $row['year_level']?></td>
											 <td>
											 <button type="submit" class="btn btn-info editbtn" name="edit_btn" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
											 <button type="submit" class="btn btn-danger deletebtn" name="delete_btn" title="Delete"> <i class="fa fa-trash" aria-hidden="true"></i></button>
											 </td>
  
											 
								  </tr>
								  <?php   
									 }
								  }
								  else{

								  }
								  ?>
									 </tbody>
										 </table>
								 
							<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModalCenter" name="add_btn"><i class="fa fa-plus" aria-hidden="true"></i>  Add Student</button>
							<!-- Button trigger modal -->

			 <!-- Modal -->
						<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
							 <div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title" id="exampleModalLongTitle">Student Form</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								  </button>
								</div>


								<form method="post">
								<div class="modal-body">
								  <input type="text" name="uid" value="<?php echo $_SESSION['id'];?>" hidden>
								  <div class="form-group">
									 <label>Firstname</label>
									 <input class="form-control <?php echo $invalid_firstname; ?>" type="text" name="firstname" required="" style="text-transform: capitalize;">
									 <!-- For CSS styles only -->
										<?php if (!$invalid_credentials): ?>
											 <div class="invalid-feedback">
												  Please enter a firstname.
											 </div>
											 <br>
										<?php endif; ?>
						  
								  </div>
								  <div class="form-group">
									 <label>Lastname</label>
									 <input class="form-control <?php echo $invalid_lastname; ?>" type="text" name="lastname" required="" style="text-transform: capitalize;">
									 <?php if (!$invalid_credentials): ?>
											 <div class="invalid-feedback">
												  Please enter a Lastname.
											 </div>
											 <br>
										<?php endif; ?>
								  </div>
								  <div class="form-group">
								  <label>Course</label>
								  <select class="form-control form-control <?php echo $invalid_course; ?>" name="course" required="">
									 <?php if (!$invalid_credentials): ?>
											 <div class="invalid-feedback">
												  Please select a Course.
											 </div>
											 <br>
										<?php endif; ?>
										<option disabled selected></option>

							<?php 
                            $connection = mysqli_connect("localhost", "root", "", "attendance-monitoring-system");
                            $uid = $_SESSION['id'];
                            $query = "SELECT * FROM courses WHERE uid ='$uid'";
                            $query_run = mysqli_query($connection, $query);
                            $courses="";
                            if(mysqli_num_rows($query_run) > 0)
                          { 
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              $courses .= '                           
										<option value="'.$row['course'].'">'.$row['course'].'</option>
     									
                                      ';
                                    }
                                 }
                                 echo $courses;

                            ?>
										
									 </select>
								  </div>

								  <div class="form-group">
								  <label>Section</label>
								  <select class="form-control form-control <?php echo $invalid_section; ?>" name="section" required="">
									 <?php if (!$invalid_credentials): ?>
											 <div class="invalid-feedback">
												  Please select a Section.
											 </div>
											 <br>
										<?php endif; ?>
										<option disabled selected></option>

							<?php 
                            $connection = mysqli_connect("localhost", "root", "", "attendance-monitoring-system");
                            $uid = $_SESSION['id'];
                            $query = "SELECT * FROM sections WHERE uid ='$uid'";
                            $query_run = mysqli_query($connection, $query);
                            $sections="";
                            if(mysqli_num_rows($query_run) > 0)
                          { 
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              $sections .= '                           
										<option value="'.$row['section'].'">'.$row['section'].'</option>
     									
                                      ';
                                    }
                                 }
                                 echo $sections;

                            ?>
										
									 </select>
								  </div>

								  <div class="form-group">
								  <label>Year/Level</label>
								  <select class="form-control form-control <?php echo $invalid_year_level; ?>" name="year_level"  required="">
									 <?php if (!$invalid_credentials): ?>
											 <div class="invalid-feedback">
												  Please select a Year Level.
											 </div>
											 <br>
										<?php endif; ?>
										<option disabled selected></option>
										<option value="First">First</option>
										<option value="Second">Second</option>
										<option value="Third">Third</option>
										<option value="Fourth">Fourth</option>
									 </select>
								  </div>
								  
								</div>

								<div class="modal-footer">
								  <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
								  <button type="submit" class="btn btn-info" name="btn_add_student">proceed</button>
								</div>
								</form>
							 </div>
						  </div>
						</div>
						<!--modal -->
						</div>
					 </div>
				  </div>
				</div>
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


  <!--EDIT POP UP FORM-->

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	 <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Edit student data</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 <span aria-hidden="true">&times;</span>
		  </button>
		</div>
			 <?php 
			if(isset($_GET["edit"]))
				  {
					 if($_GET["edit"] == "success")
					 {
						echo  '<script> alert("Successfully updated."); </script>';
					 }
					 elseif ($_GET["edit"] == "error") {
						 echo  '<script> alert("There was an error updating the data!"); </script>';
					  } 
				  }
			 ?>
			 <form action="" method="POST">
			 <div class="modal-body">
				  <input type="hidden" name="update_id" id="update_id">

				  <div class="form-group">
					 <label>Firstname</label>
					 <input type="text" name="firstname" id="firstname" class="form-control" autocomplete="off" >
				  </div>


					<div class="form-group">
					 <label>Lastname</label>
					 <input type="text" name="lastname" id="lastname" class="form-control" autocomplete="off" >
				  </div>


					<div class="form-group" >
						<label>Course</label>
						<select class="form-control form-control" name="course" id="course">
							<option disabled selected></option>
							<?php 

                            $connection = mysqli_connect("localhost", "root", "", "attendance-monitoring-system");
                            $uid = $_SESSION['id'];
                            $query = "SELECT * FROM courses WHERE uid ='$uid'";
                            $query_run = mysqli_query($connection, $query);
                            $courses="";
                            if(mysqli_num_rows($query_run) > 0)
                          { 
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              $courses .= '                           
										<option value="'.$row['course'].'">'.$row['course'].'</option>
     									
                                      ';
                                    }
                                 }
                                 echo $courses;

                            ?>
						 </select>
				  </div>

				  <div class="form-group" >
						<label>Section</label>
						<select class="form-control form-control" name="section" id="section">
							<option disabled selected></option>
							<?php 

                            $connection = mysqli_connect("localhost", "root", "", "attendance-monitoring-system");

                            $uid = $_SESSION['id'];
                            $query = "SELECT * FROM sections WHERE uid ='$uid'";
                            $query_run = mysqli_query($connection, $query);
                            $sections="";
                            if(mysqli_num_rows($query_run) > 0)
                          { 
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              $sections .= '                           
										<option value="'.$row['section'].'">'.$row['section'].'</option>
     									
                                      ';
                                    }
                                 }
                                 echo $sections;

                            ?>
						 </select>
				  </div>


				  <div class="form-group" >
						<label>Year Level</label>
						<select class="form-control form-control " name="year_level" id="year_level">
										<option disabled selected></option>
										<option value="First">First</option>
										<option value="Second">Second</option>
										<option value="Third">Third</option>
										<option value="Fourth">Fourth</option>
									 </select>
				  </div>
				  
				  
				  

			 </div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info" name="updatebtn" >Update</button>
			 </div>
			 </form>
	 </div>
  </div>
</div>

<!-- END OF DIVIDER -->
<!--DELETE POP UP FORM-->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	 <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Delete student data</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 <span aria-hidden="true">&times;</span>
		  </button>
		</div>

			 <form action="" method="POST">
			 <div class="modal-body">
			 <input type="hidden" name="delete_id" id="delete_id">
			 <center> 
			 <h4>Are you sure?</h4>

			 <p >Do you really want to delete the records of selected student? <br>This process cannot be undone.</p>
			 </center>
			 </div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
				<button type="submit" name="deletebtn" class="btn btn-danger">Yes</button>
			 </div>
			 </form>
	 </div>
  </div>
</div>

<!-- END OF DIVIDER -->

<!-- Edit button function -->

  <script>
	 
	 $(document).ready(function() {
		$('.editbtn').on('click',function(){

		  $('#editmodal').modal('show');

			 $tr = $(this).closest('tr');

			 var data = $tr.children("td").map(function(){
				return $(this).text();
			 }).get();

			 console.log(data);


			 $('#update_id').val(data[0]);
			 $('#firstname').val(data[1]);
			 $('#lastname').val(data[2]);
			 $('#course').val(data[3]);
			 $('#section').val(data[4]);
			 $('#year_level').val(data[5]);


		});
	 });
 </script>


 <!-- Delete button function -->
<script>
	 
	 $(document).ready(function() {
		$('.deletebtn').on('click',function(){

		  $('#deletemodal').modal('show');





			 $tr = $(this).closest('tr');

			 var data = $tr.children("td").map(function(){
				return $(this).text();
			 }).get();

			 console.log(data);


			 $('#delete_id').val(data[0]);


			 

		});
	 });
  </script>

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
  <!--   Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--   Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
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

	 $('#datatableid').DataTable({
		  "pagingtype": "full_numbers",
		  "lengthMenu": [
			 [10, 25, 50, -1],
			 [10, 25, 50, "All"]
		  ],
		  responsive: true,
		  language: {
			 search: "_INPUT_",
			 searchPlaceholder: "Search records..",
		  }
	 });

});

</script>
</body>

</html>