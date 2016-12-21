<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #2b3643;
	margin: 200px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #fff;
}
a {
	color: #fff;
	background-color: transparent;
	font-weight: normal;
}
h1 {
	color: #fff;
	background-color: transparent;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 0;
}

</style>
</head>
<body>
	<div id="container">
		<h1>
			<span style="font-size: 90px">500</span>
			Oops! Something went wrong. <?php echo $heading; ?>
		</h1>
		<p>We are fixing it! Please come back in a while. Try again or <a href="/">contact</a> support</p>
		<pre><?php echo $message; ?></pre>
	</div>
</body>
</html>