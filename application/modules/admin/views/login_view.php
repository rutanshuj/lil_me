<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8" />
	<title><?php echo LOGIN_HEADER;?> | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url();?>assets/login/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/login/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/login/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/login/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/login/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/login/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	
	
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url();?>assets/login/css/pages/login.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/login/images/favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login" style="background-color: transparent !important;">
	<!-- BEGIN LOGO -->
	<div class="logo" style="margin-top: 10px;">
	
	<!--<img src="<?php echo base_url().LOGIN_LOGO;?>"> -->
		
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content" style="border-style: double;">
		<!-- BEGIN LOGIN FORM -->
		<form method="post" class="form-vertical login-form" action="<?php echo base_url("admin/login/login")?>">
			<h3 class="form-title">Login to your account</h3>
            
            
            <?php
			
			if(isset($error) && !empty($error)) {
				echo "<div class=\"alert alert-error\">";
				echo "<button class=\"close\" data-dismiss=\"alert\"></button>" ;
				echo $error ;
				echo "</div>";
			}
			?>
						
			
                                

			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" id="username" placeholder="Username" name="username" value="<?php if(isset($_COOKIE["ci_user"])) {echo $_COOKIE["ci_user"];} ?>" autocomplete="off" />
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password"  id="password" 
                value="<?php if(isset($_COOKIE["ci_password"])) {echo $_COOKIE["ci_password"];} ?>"/>
					</div>
				</div>
			</div>
			<div class="form-actions">
				
				<button type="submit" class="btn green pull-right">
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button> 
<a href="<?php echo base_url("admin/register")?>">				
				Don't have an account? Sign Up here
				</a>
			</div>
		</form>
		
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright" style="color:black;">
		<b><?php echo date('Y')?> &copy; <?php echo LOGIN_HEADER;?>.</b>
	</div>
    

    
    
    
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<script src="<?php echo base_url();?>assets/login/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url();?>assets/login/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="<?php echo base_url();?>assets/login/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="<?php echo base_url();?>assets/login/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo base_url();?>assets/login/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url();?>assets/login/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
    
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url();?>assets/login/scripts/app.js" type="text/javascript"></script>

	<script src="<?php echo base_url();?>assets/login/scripts/login.js" type="text/javascript"></script>      
	<!-- END PAGE LEVEL SCRIPTS --> 
	
	<script>
		jQuery(document).ready(function() {
			 App.init();
		  Login.init();
		});
	</script></body>
<!-- END BODY -->

</html>