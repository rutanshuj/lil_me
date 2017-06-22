<?php
if(isset($status)&&($status=="1")){
	
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
                        <form action="<?php echo base_url('web/login/setnewpass')?>" method="post">
							<div class="form-group" align="center">
                                <span style="color:red"><?php if(isset($message)) echo $message; ?></span>
                            </div>
							<input type="hidden" name="email" value="<?php if(isset($email)) echo $email; ?>">
                            <div class="form-group" align="center">
                                <input type="text" class="form-control1" name="otp" placeholder="OTP" required>
                            </div>
                             <div class="form-group" align="center">
                                <input type="password" class="form-control1" name="password" placeholder="Password" required>
                            </div>
							 <div class="form-group" align="center">
                                <input type="password" class="form-control1" name="con_password" placeholder="Confirm Password" required>
                            </div>
                            <p class="text-center">
                                <button class="btn btn-info"></i> Confirm</button>
								</p>
								<p class="text-center">    <button class="btn btn-info"></i> Reset</button></p>
						
                        </form>

                       
                       

                    </div>
                </div>
            </div>
        