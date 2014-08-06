<!DOCTYPE html>
<html lang="en" class="login_page">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>24-7 LAW Admin Panel | Login</title>

		<!-- Bootstrap framework -->
		<link rel="stylesheet" href="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/bootstrap/css/bootstrap-responsive.min.css" />
		<!-- theme color-->
		<link rel="stylesheet" href="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/css/blue.css" />
		<!-- tooltip -->
		<link rel="stylesheet" href="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/lib/qtip2/jquery.qtip.min.css" />
		<!-- main styles -->
		<link rel="stylesheet" href="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/css/style.css" />

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/favicon.ico" />

		<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

		<!--[if lte IE 8]>
		<script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/ie/html5.js"></script>
		<script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/ie/respond.min.js"></script>
		<![endif]-->
		
	</head>
	<body>

		<div class="login_box">
			<form action="<?php echo site_url('auth/forgot_password'); ?>" method="post" id="pass_form">
				<div class="top_b">
					Can't sign in?
				</div>
				<div class="alert alert-info alert-login">
					Please enter your email address. You will receive a link to create a new password via email.
				</div>
				<div class="cnt_b">
					<?php echo validation_errors('<div class="alert alert-error fade in">', '</div>');?>
					<?php echo $this -> ci_alerts -> display('error'); ?><?php echo $this -> ci_alerts -> display('success'); ?>
					<div class="formRow clearfix">
						<div class="input-prepend">
							<span class="add-on">@</span>
							<input type="text" placeholder="Your email address" name="email"/>
						</div>
					</div>
				</div>
				<div class="btm_b tac">
					<button class="btn btn-inverse" type="submit">
						Request New Password
					</button>
				</div>
			</form>

			<div class="links_b links_btm clearfix">
				<span class="linkform">Never mind, <a href="<?php echo site_url('auth/login');?>">send me back to the sign-in screen</a></span>
			</div>
		</div>

		<script src="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/js/jquery.min.js"></script>
		<script src="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/js/jquery-migrate.min.js"></script>
		<script src="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/js/jquery.actual.min.js"></script>
		<script src="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/lib/validation/jquery.validate.min.js"></script>
		<script src="<?php echo base_url($this -> config -> item('BACKEND_ASSETS')); ?>/bootstrap/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {

				//* boxes animation
				form_wrapper = $('.login_box');
				function boxHeight() {
					form_wrapper.animate({
						marginTop : (-(form_wrapper.height() / 2) - 24)
					}, 400);
				};
				form_wrapper.css({
					marginTop : (-(form_wrapper.height() / 2) - 24)
				});
				$('.linkform a,.link_reg a').on('click', function(e) {
					var target = $(this).attr('href'), target_height = $(target).actual('height');
					$(form_wrapper).css({
						'height' : form_wrapper.height()
					});
					$(form_wrapper.find('form:visible')).fadeOut(400, function() {
						form_wrapper.stop().animate({
							height : target_height,
							marginTop : (-(target_height / 2) - 24)
						}, 500, function() {
							$(target).fadeIn(400);
							$('.links_btm .linkform').toggle();
							$(form_wrapper).css({
								'height' : ''
							});
						});
					});
					e.preventDefault();
				});

				//* validation
				$('#login_form').validate({
					onkeyup : false,
					errorClass : 'error',
					validClass : 'valid',
					rules : {
						identity : {
							required : true,
							minlength : 3
						},
						password : {
							required : true,
							minlength : 3
						}
					},
					highlight : function(element) {
						$(element).closest('div').addClass("f_error");
						setTimeout(function() {
							boxHeight()
						}, 200)
					},
					unhighlight : function(element) {
						$(element).closest('div').removeClass("f_error");
						setTimeout(function() {
							boxHeight()
						}, 200)
					},
					errorPlacement : function(error, element) {
						$(element).closest('div').append(error);
					}
				});
			});
		</script>
	</body>
</html>
