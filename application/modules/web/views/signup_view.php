<?php
if(isset($status)&&($status=="1")){
	echo $message;
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
                        <form action="<?php echo base_url('web/login/signup')?>" method="post" id='myForm' 
						onsubmit="return myFunction()">
                            <div class="form-group" align="center">
                                <input type="email" class="form-control1" name="email" placeholder="email" required>
                            </div>
                            <div class="form-group" align="center">
                                <input type="text" class="form-control1" name="contact" placeholder="Contact Number" required>
                            </div>
							 <div class="form-group" align="center">
                                <input type="password" class="form-control1" id='pass1'name="password" placeholder="Password" required>
                            </div>
							 <div class="form-group" align="center">
                                <input type="password" class="form-control1" id='pass2' name="conf_password" placeholder="Confirm Password" required>
                            </div>
							
                            <p class="text-center">
                                <button  class="btn btn-info"></i> Sign up</button>
							</p>
							
							<p class="text-center">
							<a href="<?php echo base_url('web/signup/login');?>" class="btn btn-info"><span>Back to Sign in</span></a>
                                
							</p>
							
							
							
						
                        </form>

                       
                       

                    </div>
					<script>
					function myFunction() {
					var pass1 = document.getElementById("pass1").value;
					var pass2 = document.getElementById("pass2").value;
					var ok = true;
					if (pass1 != pass2) {
						//alert("Passwords Do not match");
						document.getElementById("pass1").style.borderColor = "#E34234";
						document.getElementById("pass2").style.borderColor = "#E34234";
						alert("Passwords Dont Match!!!");
						ok = false;
					}
					else {
						alert("Passwords Match!!!");
					}
					
					var x = document.forms["myForm"]["email"].value;
					var atpos = x.indexOf("@");
					var dotpos = x.lastIndexOf(".");
					if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
						alert("Not a valid e-mail address");
						ok = false;
					}
					return ok;
				}
					</script>
                </div>
            </div>
        