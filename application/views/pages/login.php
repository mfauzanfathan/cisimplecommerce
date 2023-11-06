<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login - CISimpleCommerce</title>
	<meta name="description" content="cms wahyupramusinto.com">
	<meta name="author" content="Wahyu Pramusinto">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url("resources/css/bootstrap.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("resources/css/font-awesome.min.css");?>" rel="stylesheet">		
	<link href="<?php echo base_url("resources/css/style.css");?>" rel="stylesheet">
</head>
<body>
	<div class="admin-form">
		<div class="widget worange">
			<div class="widget-head">
				<i class="fa fa-lock"></i> Login - CMS fauzanolshop.com
			</div>
			<div class="widget-content">
				<div class="padd">
					<div class="text-center"><?php if(isset($error)) echo "<div class='label label-warning'>$error</div>";?></div>
					<form class="form-horizontal" method="post" action="<?php echo base_url('index.php/login/submitLogin');?>" autocomplete="off">
						<div class="form-group">
							  <label class="control-label col-lg-3" for="lusername">Username</label>
							  <div class="col-lg-9">
								<input type="text" class="form-control" id="username" name="username" placeholder="username">
							  </div>
						</div>
						<div class="form-group">
							  <label class="control-label col-lg-3" for="lpassword">Password</label>
							  <div class="col-lg-9">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							  </div>
						</div>
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<input name="Login" value="Login" type="submit" class="btn btn-danger">
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="widget-foot">&copy; www.fauzanolshop.com</div>
		</div>  
	</div>
	<script src="<?php echo base_url("resources/js/jquery.js");?>"></script>
	<script src="<?php echo base_url("resources/js/bootstrap.min.js");?>"></script>
</body>	
</html>