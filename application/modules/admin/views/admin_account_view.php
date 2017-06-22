 <style >
 .account_view{
 width: 400px ;
    margin: 1% auto;
 }
 </style>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Account settings
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Account settings</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content" >
		
		
          <div class="row" >
            <div class="register-box account_view" >
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Your Account Details </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
			 
		
			
              <div class="register-box-body">
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="input" class="form-control" id="first_name" value="<?php echo $user_details->username;?>" name="first_name" 
				  readonly>
                </div>
				
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="input" class="form-control" id="last_name" name="last_name" value="<?php echo $user_details->lastname;?>" 			  readonly>
                </div>
				
							
               <div class="form-group">
                  <label for="username">Username </label>
                  <input type="input" class="form-control" id="username" name="username"   value="<?php echo $user_details->username;?>"
				  readonly>
                </div>
				
				<div class="form-group">
                  <label for="input">Email Id</label>
                  <input type="input" class="form-control" id="email" name="email"  value="<?php echo $user_details->email_id;	?>"
				  readonly>
                </div>
				<div class="form-group">
                  <label for="primary_phone_number">Primary Phone Number</label>
                  <input type="input" class="form-control" id="primary_phone_number" name="primary_phone_number"  value="<?php echo $user_details->primary_phone_number;	?>"
				  readonly>
                </div>
				
				<div class="form-group">
                  <label for="secondary_phone_number">Secondary Phone Number</label>
                  <input type="input" class="form-control" id="secondary_phone_number" name="secondary_phone_number" value="<?php echo $user_details->secondary_phone_number;	?>"
				  
				  readonly>
                </div>
				
				<div class="form-group">
                  <label for="p_phone">Your City</label>
                  <input type="input" class="form-control" id="p_phone" name="p_phone"  value="<?php echo $user_details->city_name;	?>"

				  readonly>
                </div>
				
				<div class="form-group" style="border-color: #00acd6;float: right;" >
				<a href="<?php echo base_url('admin/admin_account_settings/edit');?>" class="btn btn-info">Edit Account Details</a>
                  
                </div>
				<div class="form-group"  style="border-color: #00acd6;">
				<a href="<?php echo base_url('admin/admin_account_settings/password_modify');?>" class="btn btn-info">Change Password</a>
                  
                </div>
				
				
				
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   