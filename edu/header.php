<?php 
	$user = $_SESSION['username'];
	$role = $_SESSION['role'];
	include_once("database.php");
	$sqlz = mysql_query("select id from users where name='$user';");
	while($infoz = mysql_fetch_array($sqlz))	{
		$ida = $infoz['id'];
	}
?>
<div class="navbar">
		<div class="navbar-inner">
			<div class="container" style="width: auto;">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </a>
		      <a class="brand" href="/htdocs/edu/home.php">EDU</a>
		      <div class="nav-collapse collapse">
		        <ul class="nav">
					<li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Student<b class="caret"></b></a>
		            <ul class="dropdown-menu">
		              <li><a href="/htdocs/edu/student/student_list.php">List</a></li>
		              <?php if($role == 1 || $role == 2)	{?>	
		              <li><a href="/htdocs/edu/student/student_form.php">Add</a></li><?php }?>		   
		            </ul>
					<li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Course<b class="caret"></b></a>
		            <ul class="dropdown-menu">
		              <li><a href="/htdocs/edu/course/course_list.php">List</a></li>
		              <?php if($role == 1 || $role == 2)	{?>
		              <li><a href="/htdocs/edu/course/course_form.php">Add</a></li><?php }?>		   
		            </ul>
				<li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Batches<b class="caret"></b></a>
		            <ul class="dropdown-menu">		              
		              <li><a href="/htdocs/edu/batch/batch_list.php">List</a></li>	
		              <?php if($role == 1 || $role == 2)	{?>
		              <li><a href="/htdocs/edu/batch/batch_form.php">Add</a></li><?php }?>	   
		            </ul><li class="dropdown">
		            <?php if($role == 1 || $role == 2 || $role == 4)	{?>
		            <li class="dropdown">
		           		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Facilitators<b class="caret"></b></a>
		            		<ul class="dropdown-menu">		              
		              			<li><a href="/htdocs/edu/facilitators/facilitators_list.php">List</a></li>	
		              			<?php if($role == 1 || $role == 2)	{?>
		              			<li><a href="/htdocs/edu/facilitators/facilitators_form.php">Add</a></li><?php }?>	   
		            		</ul>
		            </li>
		            <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a>
		            <ul class="dropdown-menu">
		              <li><a href="/htdocs/edu/reports/courses.php">Course</a></li>
		              <li><a href="/htdocs/edu/reports/batches.php">Batch</a></li>		   
		            </ul>
		            </li>
		            <?php }?>		   
		            </ul>
		            <label class="navbar-search pull-right" action="">
		          <?php echo "Welcome ".$user." ";?><br><a href="/htdocs/edu/user/logout.php">Logout</a>&nbsp
		          <?php if($_SESSION['role'] == 1)	{?>
		          |&nbsp<a href="/htdocs/edu/admin">Admin Panel</a><?php 
		          }
		          else {?>
		          |&nbsp<a href="/htdocs/edu/user/profile.php?id=<?php echo $ida;?>">My Profile</a><?php }?>
		        </label>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div>

