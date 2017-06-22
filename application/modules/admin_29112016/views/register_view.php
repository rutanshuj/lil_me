
        
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) --> 
         
		 <div class="row">
            <div class="register-box-body" style="width: 450px;margin: 0% auto;">
          <!-- general form elements -->
          <div class="box box-primary" style="
    
    margin: 0% auto;
	    border-top-color: #3c8dbc;
    border-left-color: #3c8dbc;
    border-right-color: #3c8dbc;
    border-bottom-color: #3c8dbc;
	padding-left: 20px;
    border-bottom: 3px solid #d2d6de;
    border-right: 3px solid #d2d6de;
    border-left: 3px solid #d2d6de;
">
<?php
if($this->session->flashdata('message')){
	?>
	<div style="margin-top: 23px;"></div> <?php
	echo $this->session->flashdata('message');
} else {
?>


            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight: bold;font-family: serif;">Enter your details to sign up</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
			<?php echo validation_errors(); ?>
			
              <div class="box-body">
                <div class="form-group">
                  <label for="first_name">Enter Your First Name*</label>
                  <input type="input" class="form-control" id="first_name" value="<?php if(isset($first_name)){echo $first_name;}?>" name="first_name" placeholder="First Name"
				<?php if(form_error('first_name')){?> style="border-color: #ff0000" <?php } else { ?>
				  value="<?php if(isset($first_name)){echo $first_name;}?>"
				  <?php } ?>
				  required>
                </div>
				
                <div class="form-group">
                  <label for="last_name">Enter Your Last Name</label>
                  <input type="input" class="form-control" id="last_name" name="last_name" value="<?php if(isset($last_name)){echo $last_name;}?>" placeholder="Last Name"
				<?php if(form_error('last_name')){?> style="border-color: #ff0000" <?php } else { ?>
				  value="<?php if(isset($last_name)){echo $last_name;}?>"
				  <?php } ?>

				  >
                </div>
				
				
               <div class="form-group">
                  <label for="username">Enter Username* </label>
                  <input type="input" class="form-control" id="username" name="username"   placeholder="Username" 
				  <?php if(form_error('username')){?> style="border-color: #ff0000" <?php } else { ?>
				  value="<?php if(isset($username)){echo $username;}?>"
				  <?php } ?>
				  required>
                </div>
				
				<div class="form-group">
                  <label for="password">Enter Password*</label>
                  <input type="password" class="form-control" id="password" name="password"  placeholder="Password" 
				  <?php if(form_error('password')){?> style="border-color: #ff0000"  <?php } ?>
				  required>
                </div>
				<div class="form-group">
                  <label for="re_password">Retype Password*</label>
                  <input type="password" class="form-control" id="re_password" name="re_password"  placeholder="Retype Password"
				 <?php if(form_error('re_password')){?> style="border-color: #ff0000"  <?php } ?>
				  required>
                </div>
				
				<div class="form-group">
                  <label for="email">Enter Your Email Id*</label>
                  <input type="input" class="form-control" id="email" name="email"  placeholder="Email" 
				  
				  <?php if(form_error('email')){?> style="border-color: #ff0000" <?php } else { ?>
				  value="<?php if(isset($email)){echo $email;}?>"
				  <?php } ?>
				  
				  required>
                </div>
				
				<div class="form-group">
                  <label for="p_phone">Enter Primary Phone Number*</label>
                  <input type="input" class="form-control" id="p_phone" name="p_phone"  value="<?php if(isset($p_phone)){echo $p_phone;}?>" placeholder="Primary Phone"
				<?php if(form_error('p_phone')){?> style="border-color: #ff0000" <?php } else { ?>
				  value="<?php if(isset($p_phone)){echo $p_phone;}?>"
				  <?php } ?>

				  required>
                </div>
				
				<div class="form-group">
                  <label for="s_phone">Enter Secondary Phone Number</label>
                  <input type="input" class="form-control" id="s_phone" name="s_phone"  value="<?php if(isset($s_phone)){echo $s_phone;}?>"  placeholder="Secondary Phone"

				<?php if(form_error('s_phone')){/* ?> style="border-color: #ff0000" <?php */ } else { ?>
				  value="<?php if(isset($s_phone)){echo $s_phone;}?>"
				  <?php } ?>
				  
				  >
                </div>
               <div class="form-group">
                  <label for="exampleInputPassword1" >Select Your City</label>
				  <select class="form-control"  name="city"  required>
				  
				  <?php  foreach($master_city as $row){
					  $selected ="";
					  if($row->id ==$city){
						 $selected ='selected="selected"';  
					  }
				  
				  
				  ?>
                    <option value="<?php echo $row->id;?>" <?php echo $selected;?>><?php echo $row->city_name;?></option>
				  <?php } ?>
                  </select>
				  
				  
          
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
			  <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit" >
			       
                <button type="reset" class="btn btn-info pull-right">Reset</button>
				
               
              </div>
            </form>
          <?php
}
			//if($this->session->flashdata('message')){
				?>
				
				
				<div style="    margin-bottom: 21px;
    margin-top: 12px;
    font-size: 20px;
    padding-left: 5px;">
				<a href="<?php echo base_url('admin/login');?>">Click Here to Login</a>
				</div>
				<?php
				
			//}
			?>
		  </div>
          <!-- /.box -->

         

          
       
        </div>
           
           
            
          </div><!-- /.row -->
          <!-- Main row -->
         

        </section><!-- /.content -->
     
	  
	  
   