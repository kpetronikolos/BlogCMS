<?php 
	require_once("include/db.php");
	require_once("include/sessions.php");
	require_once("include/functions.php");
?>

<?php
	if (isset($_POST["Submit"])) {
		$category = mysql_real_escape_string($_POST["Category"]);

		date_default_timezone_set("Europe/Athens");

		$currentTime=time();
	
		$dateTime=strftime("%B-%d-%Y %H:%M:%S", $currentTime);
		$admin = "Konstantinos Petronikolos";
		
		if (empty($category)) {
			$_SESSION["ErrorMessage"] = "All fields must be filled out.";
			Redirect_to("categories.php");
		} elseif (strlen($category)>99) {
			$_SESSION["ErrorMessage"] = "Too long name.";
			Redirect_to("categories.php");
		} else {
			global $connectingDB;
			// var_dump($connectingDB);die();			
			$query = sprintf("INSERT INTO category(datetime, name, creatorname) VALUES('%s', '%s', '%s')", $dateTime, $category, $admin);
			// $query = "INSERT INTO category(datetime, name, creatorname) VALUES('$dateTime','$category', '$admin' )";
			$execute = mysql_query($query);

			if ($execute) {
				$_SESSION["SuccessMessage"] = "Category added successfully.";
				Redirect_to("categories.php");
			} else {
				$_SESSION["ErrorMessage"] = "Category failed to add.";
				Redirect_to("categories.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Categories</title>

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
					<li><a href="addNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a></li>
					<li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; Categories</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; Manage Admins</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp; Comments</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp; Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>

				</ul>

			</div>	<!-- end of col-sm-2 --> 

			<div class="col-sm-10">
				<h1>Manage Categories</h1>
				<?php echo Message(); echo SuccessMessage(); ?>
				<div>
					<form action="categories.php" method="post">
						<fieldset>
							<div class="form-group">
								<label for="categoryname"><span class="FieldInfo">Name:</span></label>
								<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
							</div>
							<br>
							<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
						</fieldset>
						<br>						
					</form>
				</div>	<!-- end of div form -->

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>Sr. No</th>
							<th>Date & Time</th>
							<th>Category Name</th>
							<th>Creator Name</th>
						</tr>

						<?php
							global $connectingDB;
							$viewQuery = sprintf("SELECT * from category ORDER BY datetime desc");
							$execute = mysql_query($viewQuery);
							$SrNo = 0;

							while ($datarows = mysql_fetch_array($execute)) {
								$id = $datarows["id"];
								$date = $datarows["datetime"];
								$category = $datarows["name"];
								$creator = $datarows["creatorname"];
								$SrNo++;							
						?>

								<tr>
									<td><?php echo $SrNo; ?></td>
									<td><?php echo $date; ?></td>
									<td><?php echo $category; ?></td>
									<td><?php echo $creator; ?></td>
								</tr>

						<?php } ?>
 
					</table>
				</div>	<!-- end of div table -->
						
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