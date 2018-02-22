<?php

	require_once("include/DB.php");
	require_once("include/Sessions.php");
	require_once("include/Functions.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">

</head>
<body>
	<div style="height: 10px; background-color: #27aae1;"></div>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="blog.php"><span class="glyphicon glyphicon-text-height">Blog CMS</span></a>
			</div>	<!-- end of class navbar-header -->

			<div class="collapse navbar-collapse" id="collapse">
				<ul class="nav navbar-nav">
		  			<li class="active"><a href="dashboard.php">Home</a></li>
		  			<li><a href="blog.php">Blog</a></li>
		  			<li><a href="#">About us</a></li>
		  			<li><a href="#">Services</a></li>
		  			<li><a href="#">Contact us</a></li>
		  			<li><a href="#">Feature</a></li>
		  		</ul>

		  		<form action="blog.php" class="navbar-form navbar-right">
		  			<div class="form-group">
		  				<input type="text" class="form-control" placeholder="Search" name="Search">
		  			</div>
		  			<button class="btn btn-default" name="SearchButton">Go</button>
		  		</form>
		  	</div>	<!-- end of class navbar-collapse -->

		</div>	<!-- end of class container -->
	</nav>	<!-- end of nav -->
	<div class="Line" style="height: 10px; background-color: #27aae1;"></div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<br><br>
				<ul id="side-menu" class="nav nav-pills nav-stacked">
					<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; Dashboard</a></li>
					<li><a href="addNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a></li>
					<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; Categories</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; Manage Admins</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp; Comments</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp; Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>

				</ul>

			</div>	<!-- end of col-sm-2 --> 

			<div class="col-sm-10">				
				<div><?php echo Message(); echo SuccessMessage(); ?></div>
				<h1>Admin Dashboard</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No</th>
							<th>Post Title</th>
							<th>Date & Time</th>
							<th>Author</th>
							<th>Category</th>
							<th>Banner</th>
							<th>Comments</th>
							<th>Action</th>
							<th>Details</th>
						</tr>

						<?php
							global $connectingDB;
							$query = sprintf("SELECT * from admin_panel ORDER BY datetime desc");
							$execute = mysql_query($query);
							$SrNo = 0;
							while($datarows = mysql_fetch_array($execute)){
								$id = $datarows["id"];
								$dateTime = $datarows["datetime"];
								$title = $datarows["title"];
								$category = $datarows["category"];
								$admin = $datarows["author"];
								$image = $datarows["image"];
								$post = $datarows["post"];
								$SrNo++;
							
						?>
								<tr>
									<td><?php echo $SrNo; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $dateTime; ?></td>
									<td><?php echo $admin; ?></td>
									<td><?php echo $category; ?></td>
									<td><img src="img/<?php echo $image; ?>" width="170px"; height = "50px"></td>
									<td><?php echo "Processing"; ?></td>
									<td><a href="editPost.php?edit=<?php echo $id; ?>" target="_blank"><span class="btn btn-warning">Edit</span></a>
										<a href="deletePost.php?delete=<?php echo $id; ?>" target="_blank"><span class="btn btn-danger">Delete</span></a></td>
									<td><a href="fullPost.php?id=<?php echo $id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
								</tr>

							<?php }
							?>


					</table>
					
				</div>				
			</div>	<!-- end of col-sm-10 -->
		</div>	<!-- end of row -->
	</div>	<!-- end of container-fluid -->

	<div id="Footer">
		<hr><p>Theme By | Konstantinos Petronikolos |&copy;2017-2018 --- All rights reserved.</p>
		<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;" href="http://google.com/" target="_blank">
			<p>
				This site is only used for Study purpose. Kostas has all the rights. No one is allowed to distribute
				copies other than <br>&trade; google.com &trade;  Kostas ; &trade; Vela
			</p>
			<hr>
		</a>
		
	</div> <!-- End of Footer -->

	<div style="height: 10px; background: #27AAE1;"></div>

</body>
</html>