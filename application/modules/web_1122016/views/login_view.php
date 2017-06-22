<?php
if(isset($message)&&($message=="close")){
?>
<script>
parent.jq.fancybox.close();
</script>
<?php
}
?>
   <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.universal.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/bootstrap.min.css">
	 <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/test.css">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                      
                        <h4 class="modal-title" id="Login"> Login</h4>
                    </div>
                    <div class="modal-body" style="margin-bottom: 19%;">
                        <form action="<?php echo base_url('web/login/login')?>" method="post">
                            <div class="form-group" align="center">
                                <input type="text" class="form-control1" name="username" placeholder="email" required>
                            </div>
                            <div class="form-group" align="center">
                                <input type="password" class="form-control1" name="password" placeholder="password" required>
                            </div>
							<a href="#" style="margin-left: 15%;margin-bottom: 3%;color: #ff66d9;"><span>Forgot Password</span></a>
                            <p class="text-center">
                                <button class="btn btn-info"></i> Log in</button>
							</p>
							<p class="text-center">
							
							<a  class="btn btn-info" href="<?php echo base_url('web/signup');?>">Sign Up</a>
							
                            </p>
							<hr class="front"></hr><span class="seperator">or</span>
								<div class="social-login" style="padding-left: 10%;">
							
	                        	
								<hr class="back"></hr>
								<br>
	                        	
								<div class='so_links'><a href="<?php if(isset($authUrl))
									echo $authUrl;
								else
									echo '';?>" class="social-login-icon"><img src="<?php echo base_url();?>assets/svgs/fb.svg"  ><span>Sign in with Facebook</span></a></div>
								
		                       <div class='so_links'> <a class="social-login-icon"><img src="<?php echo base_url();?>assets/svgs/gplus.svg" ><span>Sign in with Gmail<span></a>	</div>
		                        		
	                        	
	                        </div>
                        </form>

                       
                       

                    </div>
                </div>
            </div>
        