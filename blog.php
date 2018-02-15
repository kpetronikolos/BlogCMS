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

</body>
</html>