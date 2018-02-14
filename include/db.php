<?php
	$connection = @mysql_connect('localhost', 'root', '');
	$connectingDB = @mysql_select_db('blogcms', $connection);

?>