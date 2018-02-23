<?php 
	require_once("include/db.php");
	require_once("include/sessions.php");
	require_once("include/functions.php");
?>

<?php
	if (isset($_POST["Submit"])) {
		$name = mysql_real_escape_string($_POST["Name"]);
		$email = mysql_real_escape_string($_POST["Email"]);
		$comment = mysql_real_escape_string($_POST["Comment"]);
		$status = "OFF";

		date_default_timezone_set("Europe/Athens");
		$currentTime=time();	
		$dateTime=strftime("%B-%d-%Y %H:%M:%S", $currentTime);
		
		
		$postId = $_GET['id'];
		

		if (empty($name) || empty($email) || empty($comment)){
			$_SESSION["ErrorMessage"] = "All fieds are required";
			
		} elseif (strlen($comment) > 500) {
			$_SESSION["ErrorMessage"] = "Only 500 characters are required.";
			
		} else {
			global $connectingDB;
						
			$query = sprintf("INSERT INTO comments(datetime, name, email, comment, status) VALUES('%s', '%s', '%s', '%s', '%s')", $dateTime, $name, $email, $comment, $status);
			
			$execute = mysql_query($query);			

			if ($execute) {
				$_SESSION["SuccessMessage"] = "Comment added successfully.";
				Redirect_to("fullPost.php?id={$postId}");
			} else {
				$_SESSION["ErrorMessage"] = "Comment failed to add.";
				Redirect_to("fullPost.php?id={$postId}");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Full Post</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="css/styles.css">
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
		  			<li><a href="dashboard.php">Home</a></li>
		  			<li class="active"><a href="blog.php">Blog</a></li>
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
	<div style="height: 10px; background-color: #27aae1; margin: -20px;"></div>

	<div class="container">
		<div class="blog-header">
			<h1>The Complete Responsive CMS Blog</h1>
			<p class="lead">The complete blog using php.</p>			
		</div>	<!-- end of class blog-header -->
		<div class="row">
			<div class="col-sm-8">
				<?php echo Message(); echo SuccessMessage(); ?>
				<?php
					global $connectingDB;

					if (isset($_GET["SearchButton"])) {
						$search = $_GET["Search"];
						$query = "SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%'
						OR category LIKE '%$search%' OR post LIKE '%$search%'";
					} else {
						$id = $_GET["id"];
						$query = sprintf("SELECT * from admin_panel WHERE id = '%s'", $id);
					}
					
					$execute = mysql_query($query);
					while ($datarows = mysql_fetch_array($execute)) {
						$postId = $datarows["id"];
						$datetime = $datarows["datetime"];
						$title = $datarows["title"];
						$category = $datarows["category"];
						$admin = $datarows["author"];
						$image = $datarows["image"];
						$post = $datarows["post"];
					
				?>
						<div class="blogpost thumbnail">
							<img class="img-responsive img-rounded" src="img/<?php echo $image; ?>">

							<div class="caption">
								<h1 id="heading"><?php echo htmlentities($title); ?></h1>
								<p class="description">Category: <?php echo htmlentities($category); ?> Published on <?php echo htmlentities($datetime); ?></p>
								<p class="post">
									<?php
										echo $post;
									?>
										
								</p>
							</div>
							
						</div>	<!-- end of class thumbanail -->

					<?php } ?>

					<br><br>
					<span class="FieldInfo">Share your thoughts about this post</span>
					<br><br>
					<div>
						<form action="fullPost.php?id=<?php echo $postId; ?>" method="post">
							<fieldset>
								<div class="form-group">
									<label for="Name"><span class="FieldInfo">Name:</span></label>
									<input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
								</div>

								<div class="form-group">
									<label for="Email"><span class="FieldInfo">Email:</span></label>
									<input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
								</div>
								
								<div class="form-group">
									<label for="commentarea"><span class="FieldInfo">Comment:</span></label>
									<textarea class="form-control" name="Comment" id="commentarea"></textarea>
								</div>	
								<br>
								<input class="btn btn-primary" type="Submit" name="Submit" value="Submit">
							</fieldset>
							<br>						
						</form>
					</div>	<!-- end of div form -->

			</div>	<!-- end of class col-sm-8 -->
			<div class="col-sm-offset-1 col-sm-3">
				
			</div>
		</div>	<!-- end of class row -->
	</div>	<!-- end of class container -->

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