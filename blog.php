<?php 
	require_once("include/db.php");
	require_once("include/sessions.php");
	require_once("include/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog</title>

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
				<?php
					global $connectingDB;

					if (isset($_GET["SearchButton"])) {
						$search = $_GET["Search"];
						$query = "SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%'
						OR category LIKE '%$search%' OR post LIKE '%$search%'";
					} else {
						$query = sprintf("SELECT * from admin_panel ORDER BY datetime desc");
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
										if (strlen($post)>150) {
											$post = substr($post, 0, 150). '...';
										}
										echo $post;
									?>
										
								</p>
							</div>
							<a href="fullPost.php?id=<?php echo $postId; ?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
						</div>	<!-- end of class thumbanail -->

					<?php } ?>

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