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
                                <input type="password" class="form-control1" name="password" placeholder="Contact Number" required>
                            </div>
							 <div class="form-group" align="center">
                                <input type="text" class="form-control1" name="" placeholder="Password" required>
                            </div>
							 <div class="form-group" align="center">
                                <input type="text" class="form-control1" name="username" placeholder="Confirm Password" required>
                            </div>
							
                            <p class="text-center">
                                <button class="btn btn-info"></i> Sign up</button>
							</p>
							
							<p class="text-center">
							<a href="<?php echo base_url('web/signup/login');?>" class="btn btn-info"><span>Back to Sign in</span></a>
                                
							</p>
							
							
							
						
                        </form>

                       
                       

                    </div>
                </div>
            </div>
        