<?php 
	require_once("include/db.php");
	require_once("include/sessions.php");
	require_once("include/functions.php");
?>

<?php
	if (isset($_POST["Submit"])) {
		
		global $connectingDB;
		$delete = $_GET['delete'];
		$query = sprintf("DELETE FROM admin_panel WHERE id='%d'", $delete);
		
		$execute = mysql_query($query);

		if ($execute) {
			$_SESSION["SuccessMessage"] = "Post deleted successfully.";
			Redirect_to("dashboard.php");
		} else {
			$_SESSION["ErrorMessage"] = "Post failed to delete.";
			Redirect_to("dashboard.php");
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete Post</title>

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
				<h1>Delete Post</h1>
				<?php echo Message(); echo SuccessMessage(); ?>
				<div>

				<?php
					$deleteID = $_GET['delete'];
					global $connectingDB;
					$sql = sprintf("SELECT * FROM admin_panel WHERE id='%s'", $deleteID);
					$execute = mysql_query($sql);
					while ($datarows = mysql_fetch_array($execute)) {
						$title = $datarows['title'];
						$category = $datarows['category'];
						$image = $datarows['image'];
						$post = $datarows['post'];
					}

				?>

					<form action="deletePost.php?delete=<?php echo $deleteID; ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input disabled class="form-control" type="text" name="Title" id="title" placeholder="Title" value="<?php echo $title; ?>">
							</div>
							<div class="form-group">
								<span class="FieldInfo">Existing Category:</span>
								<?php echo $category ?>
								<br>
								<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
								<select disabled class="form-control" id="categoryselect" name="Category">
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
								<span class="FieldInfo">Existing Image:</span>								
								<img src="img/<?php echo $image; ?>" width="170px"; height = "70px"> 
								<br>
								<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
								<input disabled class="form-control" type="File" name="Image" id="imageselect">
							</div>
							<div class="form-group">
								<label for="postarea"><span class="FieldInfo">Post:</span></label>
								<textarea disabled class="form-control" name="Post" id="postarea"><?php echo $post; ?></textarea>
							</div>	
							<br>
							<input class="btn btn-danger btn-block" type="Submit" name="Submit" value="Delete Post">
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