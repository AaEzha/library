<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>AMEL</title>

		<!-- Bootstrap core CSS -->
		<link href="<?=base_url().'assets/css/';?>bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="<?=base_url().'assets/css/';?>justified-nav.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<?=$this->load->view('layout/header');?>
			<?=$this->load->view($content);?>
			<?=$this->load->view('layout/footer');?>
		</div> <!-- /container -->
	</body>
</html>