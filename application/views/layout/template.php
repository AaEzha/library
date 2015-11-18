<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>AMEL</title>		<!-- Bootstrap core CSS -->
		<link href="<?=base_url().'assets/css/';?>bootstrap.min.css" rel="stylesheet">		<link href="<?=base_url().'assets/css/';?>style.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="<?=base_url().'assets/css/';?>justified-nav.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">			<div style="background-color:white;">
			<?=$this->load->view('layout/header');?>
			<!-- Jumbotron -->			<?php $this->load->view('layout/slider'); ?>
			<!-- Example row of columns -->
			<?=$this->load->view($content);?>			</div>
		</div> <!-- /container -->
		<script src="<?=base_url().'assets/js/';?>jquery.min.js"></script>
		<script src="<?=base_url().'assets/js/';?>bootstrap.min.js"></script><!-- Bootstrap -->
	</body>
</html>