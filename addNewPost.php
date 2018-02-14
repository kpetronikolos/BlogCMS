<?php 
	require_once("include/db.php");
	require_once("include/sessions.php");
	require_once("include/functions.php");
?>

<?php
	if (isset($_POST["Submit"])) {
		$title = mysql_real_escape_string($_POST["Title"]);
		$category = mysql_real_escape_string($_POST["Category"]);
		$post = mysql_real_escape_string($_POST["Post"]);

		date_default_timezone_set("Europe/Athens");
		$currentTime=time();	
		$dateTime=strftime("%B-%d-%Y %H:%M:%S", $currentTime);

		$admin = "Konstantinos Petronikolos";

		$image = $_FILES["Image"]["name"];
		$target = "img/".basename($_FILES["Image"]["name"]);
		
		if (empty($title)) {
			$_SESSION["ErrorMessage"] = "Title can't be empty.";
			Redirect_to("addNewPost.php");
		} elseif (strlen($title)<2) {
			$_SESSION["ErrorMessage"] = "Title must be at least 2 characters.";
			Redirect_to("addNewPost.php");
		} else {
			global $connectingDB;
						
			$query = sprintf("INSERT INTO admin_panel(datetime, title, category, author, image, post) VALUES('%s', '%s', '%s', '%s', '%s', '%s')", $dateTime, $title, $category, $admin, $image, $post);
			
			$execute = mysql_query($query);

			move_uploaded_file($_FILES["Image"]["tmp_name"], $target);

			if ($execute) {
				$_SESSION["SuccessMessage"] = "Post added successfully.";
				Redirect_to("addNewPost.php");
			} else {
				$_SESSION["ErrorMessage"] = "Post failed to add.";
				Redirect_to("addNewPost.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add New Post</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<h1></h1>

				<ul id="side-menu" class="nav nav-pills nav-stacked">
					<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; Dashboard</a></li>
					<li class="active"><a href="addNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a></li>
					<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; Categories</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; Manage Admins</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp; Comments</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp; Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>

				</ul>

			</div>	<!-- end of col-sm-2 --> 

			<div class="col-sm-10">
				<h1>Add New Post</h1>
				<?php echo Message(); echo SuccessMessage(); ?>
				<div>
					<form action="addNewPost.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
							</div>
							<div class="form-group">
								<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
								<select class="form-control" id="categoryselect" name="Category">
									<?php
										global $connectingDB;
										$query = sprintf("SELECT * FROM category ORDER BY datetime desc");
										$execute = mysql_query($query);
										while ($datarows = mysql_fetch_array($execute)) {
											$categoryName = $datarows["name"];										
									?>
											<option><?php echo $categoryName; ?></option>

										<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
								<input class="form-control" type="File" name="Image" id="imageselect">
							</div>
							<div class="form-group">
								<label for="postarea"><span class="FieldInfo">Post:</span></label>
								<textarea class="form-control" name="Post" id="postarea"></textarea>
							</div>	
							<br>
							<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">
						</fieldset>
						<br>						
					</form>
				</div>	<!-- end of div form -->						
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